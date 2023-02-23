<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class SignUpSendCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $users_table = with(new User())->getTable();
        return [
            'phone' => ['required', 'string', "unique:$users_table,phone"],
            'method' => ['required', 'string', 'in:sms,call'],
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => 'Пользователь с таким номером телефона уже зарегистрирован, попробуйте авторизоваться',
        ];
    }
}
