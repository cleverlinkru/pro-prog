<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\QuickBuyRequest;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\User;
use App\Services\Analytics;
use App\Services\Payment;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class QuickBuyController extends Controller
{
    public function __construct(protected Analytics $analytics, protected Payment $payment)
    {
    }

    public function show(Product $product)
    {
        return Inertia::render('Shop/QuickBuy', [
            'product' => $product,
        ]);
    }

    public function buy(QuickBuyRequest $request, Product $product)
    {
        $phone = $request->input('phone');

        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $user = User::create([
                'name' => '',
                'phone' => $phone,
            ]);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'meta' => [
                'yandexClientId' => $this->analytics->getYandexClientId(),
            ],
        ]);

        $confirmationUrl = $this->payment->pay($order->price, $order->id, $order->product->title);

        return Inertia::location($confirmationUrl);
    }

    public function confirm()
    {
        $res = $this->payment->confirm();

        if (!$res['success']) {
            return response('Error', 500);
        }

        $order = Order::findOrFail($res['orderId']);
        $order->update([
            'paid' => true,
        ]);

        if ($order->meta['yandexClientId']) {
            $this->analytics->sendYandexConversion($order->price, $order->meta['yandexClientId']);
        }
    }
}
