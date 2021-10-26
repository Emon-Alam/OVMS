<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use App\WorkRequest;

class PaymentController extends Controller
{
    public function showPayment(Request $request, $id)
    {
        $workRequest = WorkRequest::where('id', $id)
            ->orWhere('user_id', $request->session()->get('userid'))
            ->orWhere('volunteer_id', $request->session()->get('userid'))
            ->first();

        $paymentBudgetArray = [
            "Heavy-Weight-Groceries" => 1500,
            "Heavy-Weight-Delivering-Parcel" => 2500,
        ];



        $workRequest->details = explode(">", $workRequest->details)[3];
        $workRequest->details = explode("<", $workRequest->details)[0];
        $workRequest->details = explode(" ", $workRequest->details)[2];

        $paymentAmount = $paymentBudgetArray[$workRequest->details];

        return view('payment.payment')->with('amount', $paymentAmount);
    }
    public function paymentStore(Request $request, $id)
    {
        $workRequest = WorkRequest::where('id', $id)
            ->orWhere('user_id', $request->session()->get('userid'))
            ->orWhere('volunteer_id', $request->session()->get('userid'))
            ->first();
        if ($workRequest) {

            $user = User::find($id);

            $payment = new Payment;
            $payment->work_id = $id;
            $payment->u_id = $workRequest->user_id;
            $payment->v_id = $workRequest->volunteer_id;
            $payment->payment_type = $request->payment_type;
            if ($payment->payment_type == "cash_payment") {

                $payment->card_name = "empty";
                $payment->card_number = "empty";
                $payment->expire = "empty";
                $payment->cvv = "empty";
                $payment->status = "Done";
                $payment->price = "400";
            } else {
                $payment->card_name = $request->card_name;
                $payment->card_number = $request->card_number;
                $payment->expire = $request->expire;
                $payment->cvv = $request->cvv;
                $payment->status = "Done";
                $payment->price = "400";
            }

            $payment->save();

            return redirect()->route('review')->with('id', $id)->with('user', $user)->with('payment', $payment);
        } else {
            return back();
        }

        return back();
    }
}
