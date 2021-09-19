@extends('dashboard.dashboardlayout')

@section('content')

<div class="container-fluid top-container">

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" height="150px" src="{{ asset('assets/images/users/user' . session('userid') . '.jpg') }}">
                    @include('dashboard.uploadModal')
                    <form method="post" enctype='multipart/form-data' class="mx-3 loginForm">
                        @csrf
                        <h4><span class="font-weight-bold">{{ session('username') }}</span></h4>
                        <span class="text-black-50">{{ $user->email}}</span><span> </span>
                </div>
            </div>

            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label>
                        <input type="text"  name = "first_name" class="form-control" placeholder="first name" value="{{ $user->first_name }}"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label>
                        <input type="text" name = "last_name" class="form-control" value="{{ $user->last_name }}" placeholder="last name"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Username</label>
                        <input type="text" name = "username" class="form-control" placeholder="enter username" value="{{ $user->username }}"></div>
                        <div class="col-md-12"><label class="labels">Email Address</label>
                        <input type="text" name = "email" class="form-control" placeholder="enter email" value="{{ $user->email}}"></div>
                        <div class="col-md-12"><label class="labels">Phone</label>
                        <input type="text" name = "phone" class="form-control" placeholder="enter phone" value="{{ $user->phone}}"></div>
                        <div class="col-md-12"><label class="labels">Address</label>
                        <input type="text" name = "address" class="form-control" placeholder="enter address" value="{{ $user->address }}"></div>
                    <div class="col-md-12"><label class="labels">Gender</label>
                        <input type="text" name = "gender" class="form-control" placeholder="enter gender" value="{{ $user->gender }}"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDate_of_birth1" class="form-label">Date of birth</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}" id="exampleInputDate_of_birth1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputNational_id1" class="form-label">NID</label>
                        <input type="number" name="national_id" class="form-control" value="{{ $user->national_id }}" id="exampleInputNational_id1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputNational_id1" class="form-label">User Type</label>
                        <select type="dropdown" name="usertype" value="{{ $user->usertype }}" class="form-select w-50">
                            <option>User</option>
                            <option>Volunteer</option>
                        </select>
                    </div>


                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                            Profile</button></div>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>

@endsection