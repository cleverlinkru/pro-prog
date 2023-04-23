<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignInSendCodeRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\SignUpSendCodeRequest;
use App\Models\User;
use App\Services\Message\Message;
use App\Services\MobileVerify;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function __construct(protected MobileVerify $mobileVerify)
    {
    }

    public function main()
    {
        return Inertia::render('Auth');
    }

    public function signInSendCode(SignInSendCodeRequest $request)
    {
        $phone = $request->input('phone');
        $method = $request->input('method');

        $this->sendCode($phone, $method);

        return redirect(route('auth.main'));
    }

    public function signUpSendCode(SignUpSendCodeRequest $request)
    {
        $phone = $request->input('phone');
        $method = $request->input('method');

        $this->sendCode($phone, $method);

        return redirect(route('auth.main'));
    }

    public function signIn(SignInRequest $request)
    {
        $phone = $request->input('phone');
        $code = $this->prepareCode($request->input('code'));

        $res = $this->mobileVerify->checkCode($phone, $code);

        if ($res) {
            $user = User::where('phone', $phone)->firstOrFail();
            Auth::login($user, true);
            session()->regenerate();

            Message::show('Вы успешно авторизованы');

            return redirect(route('home'));
        } else {
            Message::show($this->mobileVerify->getErrMsg(), false);
        }
    }

    public function signUp(SignUpRequest $request)
    {
        $phone = $request->input('phone');
        $code = $this->prepareCode($request->input('code'));

        $res = $this->mobileVerify->checkCode($phone, $code);

        if ($res) {
            $name = $request->input('name');
            $user = User::create([
                'name' => $name,
                'phone' => $phone,
            ]);
            Auth::login($user, true);
            session()->regenerate();

            Message::show('Вы успешно зарегистрированы');

            return redirect(route('home'));
        } else {
            Message::show($this->mobileVerify->getErrMsg(), false);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('auth.main');
    }


    protected function sendCode(string $phone, string $method)
    {
        if ($method == 'sms') {
            $res = $this->mobileVerify->sendCode($phone);
        } else {
            if ($method == 'call') {
                $res = $this->mobileVerify->callCode($phone);
            }
        }

        if ($res) {
            Message::show($method == 'sms' ? 'Код отправлен вам в смс' : 'Вам поступит звонок с кодом');
        } else {
            Message::show($this->mobileVerify->getErrMsg(), false);
        }
    }

    protected function prepareCode(string $code)
    {
        return trim(str_replace(['-'], '', $code));
    }
}
