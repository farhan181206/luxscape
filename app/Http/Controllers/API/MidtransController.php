<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback()
    {
        // set config midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
        // buat intence midtrans notification
        $notification = new Notification();
        // assign variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment->type;
        $fraud = $notification->fraund_status;
        $order_id = $notification->order_id;
        // get transaction id
        $order = explode('-' , $order_id);
        // cari transaction berdasarkan id
        $transaction = Transaction::findOrFail($order[1]);
        // handle notification status midtrans
        if($status == 'capture'){
            if($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if($status == 'settlement')
        {
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'PENDING')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'deny')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'expire')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'cancel')
        {
            $transaction->status = 'CANCELLED';
        }
        // simpan transaction 
        $transaction->save();
        // return response untuk midtrans
        return response()->json([
            'code' => 200,
            'message' => 'Midtrans Notification Success'
        ]);

    }
}
