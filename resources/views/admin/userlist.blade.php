@extends('dashboard.dashboardlayout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<div class="container-fluid top-container">


    <div class="container">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>All User List</title>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        </head>

        <body>
            <center>
                @if (session('msg'))
                <h4 class="text-center text-success">{{ session('msg') }}</h4>
                @endif

                <h3 class="p-3">All User List</h3>


                <form action="{{route('admin.userlistview')}}" method="get">

                    <table class="table table-hover table-bordered border-info" border="1" style="width: 100%">
                        <div class="justify-content-center">

                            <tr class="table-info">
                                <td class="text-uppercase">Id</td>
                                <td class="text-uppercase">Username</td>
                                <td class="text-uppercase">First Name</td>
                                <td class="text-uppercase">Last Name</td>
                                <td class="text-uppercase">Email</td>
                                <td class="text-uppercase">Phone</td>
                                <td class="text-uppercase">Address</td>
                                <td class="text-uppercase">National ID</td>
                                <td class="text-uppercase">Gender</td>
                                <td class="text-uppercase">Date of Birth</td>
                                <td class="text-uppercase">User Type</td>
                                <td class="text-uppercase">Action</td>
                            </tr>
                        </div>

                        @foreach($list as $key => $lists)
                        <tr class="">

                            <td>{{ $lists->id }}</td>
                            <td class="text-uppercase">{{ $lists->username }}</td>
                            <td class="text-uppercase">{{ $lists->first_name }}</td>
                            <td class="text-uppercase">{{ $lists->last_name }}</td>
                            <td>{{ $lists->email }}</td>
                            <td>{{ $lists->phone}}</td>
                            <td class="text-uppercase">{{ $lists->address }}</td>
                            <td>{{ $lists->national_id }}</td>
                            <td class="text-uppercase">{{ $lists->gender }}</td>
                            <td>{{ $lists->date_of_birth }}</td>
                            <td class="text-uppercase">{{ $lists->usertype }}</td>


                            <td>
                                <div>

                                    <a class="btn btn-primary" href="{{ route('admin.edit', $lists->id) }}">Edit</a>
                                </div>
                                <div class="pt-2">

                                    <form action="{{route('admin.delete',$lists->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>

                            </td>
                            @endforeach

                            </section>
                    </table>

                </form>

            </center>
        </body>
    </div>
</div>

</html>
<br><br>
@endsection