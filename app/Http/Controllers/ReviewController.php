<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use App\WorkRequest;
use App\Review;
use App\VolunteerInformation;

class ReviewController extends Controller
{
    public function review(Request $request)
    {

        $user = User::where('id', $request->session()->get('userid'))->first();

        // dd($user);

        return view('review.review')->with('user', $user);
    }

    public function reviewStore(Request $request)
    {
        $workRequest = WorkRequest::where('user_id', $request->session()->get('userid'))
            ->orWhere('volunteer_id', $request->session()->get('userid'))
            ->first();

        if ($workRequest) {

            $user = User::where('id', $request->session()->get('userid'))->first();

            $review = new Review;
            $review->work_id = $workRequest->id;
            $review->u_Id = $workRequest->user_id;
            $review->v_Id = $workRequest->volunteer_id;
            $review->u_name = $user->username;
            $review->u_email = $user->email;
            $review->details = $request->details;
            $review->rating = $request->rating;


            $review->save();

            return redirect()->route('dashboard')->with('user', $user)->with('review', $review);
        } else {
            return back();
        }

        return back();
    }
}
