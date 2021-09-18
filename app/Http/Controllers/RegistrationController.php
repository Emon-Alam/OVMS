<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }


    public function store(Request $request){ 
    
    

        if($request->hasFile('myfile')){
            $file = $request->file('myfile');  
            
            $filename = time().".".$file->getClientOriginalExtension();

            $file->move('upload', $filename);

            $user = new User();
            $user->username        = $request->username;
            $user->password         = $request->password;
            $user->email            = $request->email;
            $user->first_name     = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->gender       = $request->gender;
            $user->address      = $request->address;
            $user->phone       = $request->phone;
            $user->usertype         = $request->usertype;
            $user->national_id       = $request->national_id;
            $user->date_of_birth     = $request->date_of_birth;
            $user->profile_img  = $filename;
            $user->save();
        
        $request->session()->flash('msg', 'Registration is successful! Please login...');
        return redirect()->route('login');
    }
        
}
}
