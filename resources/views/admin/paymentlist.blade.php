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
            <title>All Payment List</title>
        </head>

        <body>
            <center>
                @if (session('msg'))
                <h4 class="text-center text-success">{{ session('msg') }}</h4>
                @endif

                <h3 class="p-3">All Payment List</h3>
                <form action="{{route('admin.paymentlistview')}}" method="get">



                    <table class="table table-hover table-bordered border-info" border="1" style="width: 100%">
                        <div class="justify-content-center">

                            <tr class="table-info">
                                <td class="text-uppercase">Id</td>
                                <td class="text-uppercase">Work Id</td>
                                <td class="text-uppercase">User Id</td>
                                <td class="text-uppercase">User Name</td>
                                <td class="text-uppercase">Volunteer Id</td>
                                <td class="text-uppercase">Payment Type</td>
                                <td class="text-uppercase">Amount</td>
                                <td class="text-uppercase">Status</td>
                                <td class="text-uppercase">Card Name</td>
                                <td class="text-uppercase">Card Number</td>
                                <td class="text-uppercase">Expire</td>
                                <td class="text-uppercase">CVV</td>
                                <td class="text-uppercase">Time</td>
                                <td class="text-uppercase">Action</td>
                            </tr>
                        </div>
                        @foreach($list as $key => $lists)

                        <tr class="">
                            <td>{{ $lists->id }}</td>
                            <td class="text-uppercase">{{ $lists->work_id }}</td>
                            <td class="text-uppercase">{{ $lists->u_id }}</td>
                            <td class="text-uppercase">{{ $lists->username }}</td>
                            <td class="text-uppercase">{{ $lists->v_id }}</td>
                            <td class="text-uppercase">{{ $lists->payment_type }}</td>
                            <td class="text-uppercase">{{ $lists->price }}</td>
                            <td class="text-uppercase">{{ $lists->status}}</td>
                            <td class="text-uppercase">{{ $lists->card_name }}</td>
                            <td class="text-uppercase">{{ $lists->card_number }}</td>
                            <td class="text-uppercase">{{ $lists->expire }}</td>
                            <td class="text-uppercase">{{ $lists->cvv }}</td>
                            <td class="text-uppercase">{{ $lists->created_at }}</td>



                            <td>

                                <div class="pt-2">

                                    <form action="{{route('admin.paymentdelete',$lists->id)}}" method="post">
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