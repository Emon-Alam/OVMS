<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserListRequest;

class AdminController extends Controller
{
    public function view(Request $request)
    {
        $userlist = User::all()->where('usertype', '!=', 'Admin');
        // dd($userlist);
        return view('admin.userlist')->with('list', $userlist);
    }

    public function edit($id)
    {
        $userlist = User::find($id);
        return view('admin.useredit')->with('list', $userlist);
    }

    public function update(UserListRequest $request, $id)
    {

        $user = User::find($id);
        $user->username = $request->username;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->usertype = $request->usertype;
        $user->national_id = $request->national_id;
        $user->date_of_birth = $request->date_of_birth;

        $user->save();

        $request->session()->flash('msg', 'update is successful!');
        return redirect()->route('admin.view');
    }


    public function delete($id, Request $request)
    {

        $user = User::find($id);
        //dd($user);
        $user->delete();

        $request->session()->flash('msg', 'Account removed successfully...');
        return redirect()->route('admin.view');
    }
}
