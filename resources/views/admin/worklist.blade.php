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
            <title>All Work List</title>
        </head>

        <body>
            <center>
                @if (session('msg'))
                <h4 class="text-center text-success">{{ session('msg') }}</h4>
                @endif

                <h3 class="p-3">All Work List</h3>
                <form action="{{route('admin.worklistview')}}" method="get">



                    <table class="table table-hover table-bordered border-info" border="1" style="width: 100%">
                        <div class="justify-content-center">

                            <tr class="table-info">
                                <td class="text-uppercase">Id</td>
                                <td class="text-uppercase">Work Id</td>
                                <td class="text-uppercase">User Id</td>
                                <td class="text-uppercase">Volunteer Id</td>
                                <td class="text-uppercase">Work Details</td>
                                <td class="text-uppercase">Status</td>
                                <td class="text-uppercase">Start Time</td>
                                <td class="text-uppercase">End Time</td>
                                <td class="text-uppercase">Action</td>
                            </tr>
                        </div>
                        @foreach($list as $key => $lists)

                        @php

                        $data=$lists->details;
                        @endphp
                        <tr class="">
                            <td>{{ $lists->id }}</td>
                            <td class="text-uppercase">{{ $lists->work_id }}</td>
                            <td class="text-uppercase">{{ $lists->user_id }}</td>
                            <td class="text-uppercase">{{ $lists->volunteer_id }}</td>
                            <td class="text-uppercase"> {!! $data !!}</td>
                            <td class="text-uppercase">{{ $lists->status }}</td>
                            <td class="text-uppercase">{{ $lists->created_at }}</td>
                            <td class="text-uppercase">{{ $lists->expired_at }}</td>


                            <td>

                                <div class="pt-2">

                                    <form action="{{route('admin.workdelete',$lists->id)}}" method="post">
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