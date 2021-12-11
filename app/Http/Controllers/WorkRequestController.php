<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WorkRequest;
use App\Work;
use App\VolunteerInformation;
use App\User;
use App\WorkChat;
use App\Chat;

use App\Http\Requests\ChatRequest;

class WorkRequestController extends Controller
{
    public function requestWork(Request $request, $id)
    {

        $user = User::find($id);

        if ($user) {
            $oldWorkRequest = WorkRequest::where('user_id', $id)->first();

            if ($oldWorkRequest) {
                //$oldWorkRequest->delete();
            }

            $newWorkRequest = new WorkRequest;

            $newWorkRequest->user_id = $id;
            $newWorkRequest->volunteer_id = $request->volunteerId;
            $newWorkRequest->details = "<strong>" . $user->username . "</strong>" . " is Looking to Hire your<br>" . $request->details;
            $newWorkRequest->status = "waiting";
            $newWorkRequest->latitude = $request->latitude;
            $newWorkRequest->longitude = $request->longitude;
            $newWorkRequest->expired_at = date("Y-m-d H:i:s", time() + 60);
            if ($newWorkRequest->save()) {
                return response()->json($newWorkRequest);
            } else {
                return response()->json("failed");
            }
        } else {
            return response()->json("failed");
        }
    }


    public function fetchWork(Request $request, $v_id)
    {

        $workRequest = WorkRequest::where('volunteer_id', $v_id)->where('status', 'waiting')->first();

        if ($workRequest) {
            return response()->json($workRequest);
        } else {
            return response()->json(false);
        }
    }

    public function removeRequest(Request $request, $id)
    {
        $workRequest = WorkRequest::find($id);
        if ($workRequest->status == "waiting") {

            if ($workRequest->delete()) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }
    public function isExist(Request $request, $id)
    {
        $workRequest = WorkRequest::find($id);

        if ($workRequest) {
            if ($workRequest->status == "accepted") {
                return response()->json("accepted");
            }
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function acceptReqeust(Request $request, $id)
    {
        $workRequest = WorkRequest::find($id);

        if ($workRequest) {
            $workRequest->status = "accepted";
            if ($workRequest->save()) {
                $volunteer  = VolunteerInformation::where('userid', $workRequest->volunteer_id)->first();
                $volunteer->availablity = "no";
                if ($volunteer->save()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function ongoingView(Request $request, $id)
    {
        //Finding Work Request based on Usertype==============
        $workRequest = WorkRequest::where('status', "accepted");
        $user = $request->session()->get('usertype');
        if ($user == 'User') {
            $workRequest = $workRequest->where('user_id', $request->session()->get('userid'));
        } else if ($user == 'Volunteer') {
            $workRequest = $workRequest->where('volunteer_id', $request->session()->get('userid'));
        }
        $workRequest = $workRequest->first();
        //Finding Work Request based on Usertype===============


        if ($workRequest) {
            if ($workRequest->status != 'accepted') {
                return redirect()->route('dashboard');
            } else {
                $workChat = WorkChat::where('work_id', $workRequest->id)->first();

                if ($workChat) {
                } else {
                    $workChat = new WorkChat;
                    $workChat->work_id = $workRequest->id;
                    $workChat->chat_id = "C" . $workRequest->id;
                    $workChat->save();
                }

                $volunteerInfo = VolunteerInformation::where('userid', $workRequest->volunteer_id)->first();


                $chatName = "";
                $isUser = false;

                if ($workRequest->user->id == $request->session()->get('userid')) {
                    $chatName = $workRequest->volunteer;
                } else {
                    $chatName = $workRequest->user;
                    $isUser = true;
                }

                return view("work.ongoing")->with('id', $id)->with('workRequest', $workRequest)->with('volunteer', $volunteerInfo)->with('chatName', $chatName)->with('isUser', $isUser);
            }
        }

        return redirect()->route('dashboard');
    }


    public function chatFetch(Request $request, $workId, $updatedAt)
    {


        $workRequest = WorkRequest::where('id', $workId)
            // ->orWhere('user_id', $request->session()->get('userid'))
            // ->orWhere('volunteer_id', $request->session()->get('userid'))
            ->first();


        if ($workRequest) {
            $chat = Chat::where('chat_id', "C" . $workRequest->id)
                //->where('updated_at', ">=", $updatedAt)
                ->get();
            $status = $workRequest->status;
            $jsonArray = array($workId, $updatedAt, date('Y-m-d H:i:s'), $chat, $status);

            return response()->json($jsonArray);
        } else {
            return null;
        }
    }

    public function chatSend(ChatRequest $request, $workId)
    {
        $senderId = $request->session()->get('userid');
        $workRequest = WorkRequest::where('id', $workId)->first();
        if ($workRequest) {
            if ($workRequest->user_id == $senderId) {
                $reciever_id = $workRequest->volunteer_id;
            } else {
                $reciever_id = $workRequest->user_id;
            }

            $chat = new Chat;
            $chat->chat_id = "C" . $workRequest->id;
            $chat->sender_id = $senderId;
            $chat->reciever_id = $reciever_id;
            $chat->message = $request->message;

            if ($chat->save()) {
                return response()->json(array($chat, date('Y-m-d H:i:s')));
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function worklistview(Request $request)
    {
        $workRequest = WorkRequest::where('status', "accepted")
            ->where('user_id', $request->session()->get('userid'))
            ->get();
        // $workRequest = WorkRequest::all();

        //dd($workRequest);
        return view('user.worklist')->with('list', $workRequest);
    }

    public function workFinish(Request $request)
    {
        if ($request->type == 'complete') {

            $workRequest = WorkRequest::find($request->workId);
            $workRequest->status = "completed";
            if ($workRequest->status == "completed") {
                $work = new Work;

                $work->work_id = $workRequest->id;
                $work->user_id = $workRequest->user_id;
                $work->volunteer_id = $workRequest->volunteer_id;
                $work->details = $workRequest->details;
                $work->latitude = $workRequest->latitude;
                $work->longitude = $workRequest->longitude;
                $work->expired_at = $workRequest->expired_at;
                $work->status = "completed";
                $work->save();
                $workRequest->save();
                //$workRequest->delete();

                return response()->json('WorkRequest Complete');
            }
        }
        if ($request->type == 'cancel') {

            $workRequest = WorkRequest::find($request->workId);
            $workRequest->status = "canceled";
            $workRequest->save();
            return response()->json('WorkRequest canceled');
        }
    }

    public function volunteerwork(Request $request)
    {
        $work = Work::where('volunteer_id', $request->session()->get('userid'))
        ->get();

        return view('volunteer.worklist')->with('list', $work);
    }
}
