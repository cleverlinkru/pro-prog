<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\QuickBuyRequest;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\User;
use App\Services\YooKassa\Client;
use Inertia\Inertia;

class QuickBuyController extends Controller
{
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
        ]);

        $client = new Client();
        $client->setAuth(config('yookassa.shopId'), config('yookassa.secretKey'));
        $payment = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $order->price,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => config('yookassa.returnUrl'),
                ),
                'capture' => true,
                'description' => 'Order '.$order->id,
                'receipt' => array(
                    'customer' => array(
                        'email' => 'contact@clever-link.ru',
                    ),
                    'items' => array(
                        array(
                            'description' => $order->product->title,
                            'amount' => array(
                                'value' => $order->price,
                                'currency' => 'RUB',
                            ),
                            'vat_code' => '1',
                            'quantity' => '1',
                        ),
                    ),
                ),
            ),
            uniqid('', true)
        );
        $url = $payment->getConfirmation()->getConfirmationUrl();

        return Inertia::location($url);
    }
}
