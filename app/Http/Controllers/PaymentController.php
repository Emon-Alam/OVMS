<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;

class PaymentController extends Controller
{
    public function showPayment()
    {

        return view('payment.payment');
    }
    public function paymentStore(Request $request, $id)
    {
        $user = User::find($id);

        $payment = new Payment;
        $payment->u_id = $id;
        $payment->v_id = $request->v_Id;
        $payment->cash = "500";
        $payment->card_name = $request->card_name;
        $payment->card_number = $request->card_number;
        $payment->expire = $request->expire;
        $payment->cvv = $request->cvv;
        $payment->status = "Done";
        $payment->price = "400";

        $payment->save();

        return view('review.review')->with('id', $id)->with('user', $user)->with('payment', $payment);
    }
}
