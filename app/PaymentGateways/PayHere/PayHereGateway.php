<?php

namespace App\PaymentGateways\PayHere;

use App\Models\Booking;
use App\Models\PaymentOption;
use App\Models\Transaction;

class PayHereGateway
{
    public static function payhereCheckout($order)
    {
        // TODO: get active gateway datails

        $paymentGateway = PaymentOption::where(['option' => 'pay-here', 'status' => 1])->first();

        $amount = $order->patial_amount > 0 ? $order->patial_amount : $order->total_amount;
        $hash = self::generateHash($paymentGateway->key, $paymentGateway->secret, $amount, $order->id, 'LKR');

        $data = [
            'first_name'    =>  $order->first_name,
            'last_name'     => $order->last_name,
            'email'         =>  $order->email,
            'phone'         =>  $order->mobile,
            'address'       =>  $order->address,
            'city'          =>  $order->city,
            'country'       =>  $order->country,
            'order_id'      =>  $order->id,
            'items'         =>  "INV-" . $order->id,
            'currency'      =>  'LKR',
            'amount'        =>  $amount,
            'merchant_id'   =>  $paymentGateway->key,
            'hash'          =>  $hash,
            'return_url'    =>  route('success', $order->id),
            'cancel_url'    =>  route('checkout'),
            'notify_url'    =>  route('success', $order->id),
        ];

        return $data;
    }

    public static function generateHash($mId, $secret, $amount, $orderId, $currency)
    {
        $hash = strtoupper(
            md5(
                $mId .
                    $orderId .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($secret))
            )
        );

        return $hash;
    }

    public static function generateSignature($mId, $secret, $amount, $orderId, $currency, $statusCode)
    {
        $md5sig = strtoupper(
            md5(
                $mId .
                    $orderId .
                    $amount .
                    $currency .
                    $statusCode .
                    strtoupper(md5($secret))
            )
        );
        return $md5sig;
    }

    public static function validateResponseSignature($data)
    {
        $paymentGateway = PaymentOption::where(['option' => 'pay-here', 'status' => 1])->first();

        $merchantId = $data->merchant_id;
        $orderId = $data->order_id;
        $amount = $data->payhere_amount;
        $currency = $data->payhere_currency;
        $statusCode = $data->status_code;
        $md5sig = $data->md5sig;

        $merchantSecret = $paymentGateway->secret; 

        $local_md5sig = strtoupper(
            md5(
                $merchantId .
                    $orderId .
                    $amount .
                    $currency .
                    $statusCode .
                    strtoupper(md5($merchantSecret))
            )
        );
        $transaction = Transaction::where(['booking_id'=>$orderId])->first();
        
        
        if ($local_md5sig === $md5sig) {
            if($statusCode == 2) {
                $transaction->status = 'success';
            } else if($statusCode == 0) {
                $transaction->status = 'pending';
            } else if($statusCode == -1) {
                $transaction->status = 'canceled';
            } else if($statusCode == -2) {
                $transaction->status = 'failed';
            } else if($statusCode == -3) {
                $transaction->status = 'chargedback';
            }
            $transaction->save();
        }
    }
}
