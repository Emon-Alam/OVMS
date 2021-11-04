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
            <title>All Review List</title>
        </head>

        <body>
            <center>
                @if (session('msg'))
                <h4 class="text-center text-success">{{ session('msg') }}</h4>
                @endif

                <h3 class="p-3">All Review List</h3>
                <form action="{{route('admin.reviewlistview')}}" method="get">



                    <table class="table table-hover table-bordered border-info" border="1" style="width: 100%">
                        <div class="justify-content-center">

                            <tr class="table-info">
                                <td class="text-uppercase">Id</td>
                                <td class="text-uppercase">Work Id</td>
                                <td class="text-uppercase">User Id</td>
                                <td class="text-uppercase">User Name</td>
                                <td class="text-uppercase">User Email</td>
                                <td class="text-uppercase">Volunteer Id</td>
                                <td class="text-uppercase">Review Details</td>
                                <td class="text-uppercase">Rating</td>
                                <td class="text-uppercase">Date Time</td>
                                <td class="text-uppercase">Action</td>
                            </tr>
                        </div>
                        @foreach($list as $key => $lists)

                        <tr class="">
                            <td>{{ $lists->id }}</td>
                            <td class="text-uppercase">{{ $lists->work_id }}</td>
                            <td class="text-uppercase">{{ $lists->u_Id }}</td>
                            <td class="text-uppercase">{{ $lists->u_name }}</td>
                            <td class="text-uppercase">{{ $lists->u_email }}</td>
                            <td class="text-uppercase">{{ $lists->v_Id }}</td>
                            <td class="text-uppercase">{{ $lists->details}}</td>
                            <td class="text-uppercase">{{ $lists->rating }}</td>
                            <td class="text-uppercase">{{ $lists->created_at }}</td>



                            <td>

                                <div class="pt-2">

                                    <form action="{{route('admin.reviewdelete',$lists->id)}}" method="post">
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
@endsection