<?php

namespace App\Services;

use App\Services\YooKassa\Client;
use App\Services\YooKassa\Model\Notification\NotificationSucceeded;
use App\Services\YooKassa\Model\Notification\NotificationWaitingForCapture;
use App\Services\YooKassa\Model\NotificationEventType;
use Exception;

class Payment
{
    public function pay(int $price, int $orderId, string $productTitle): string
    {
        $client = new Client();
        $client->setAuth(config('payment.yookassa.shopId'), config('payment.yookassa.secretKey'));

        $payment = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $price,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => config('payment.yookassa.returnUrl'),
                ),
                'capture' => true,
                'description' => 'Order '.$orderId,
                'metadata' => array(
                    'orderId' => $orderId,
                ),
                'receipt' => array(
                    'customer' => array(
                        'email' => 'contact@clever-link.ru',
                    ),
                    'items' => array(
                        array(
                            'description' => $productTitle,
                            'amount' => array(
                                'value' => $price,
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
        $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

        return $confirmationUrl;
    }

    public function confirm()
    {
        try {
            $requestBody = request()->all();
            $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
                ? new NotificationSucceeded($requestBody)
                : new NotificationWaitingForCapture($requestBody);
        } catch (Exception $e) {
            return ['success' => false];
        }

        $payment = $notification->getObject();
        $metadata = $payment->getMetadata();
        $orderId = $metadata['orderId'];

        return [
            'success' => true,
            'orderId' => $orderId,
        ];
    }
}
