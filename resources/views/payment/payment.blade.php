@extends('layout')
@section('content')
<div class="container top-container">

    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}" />
    <form class="w-75 m-auto" method="post" action="{{ route('payment.store') }}">
        @csrf
        <div class="container mt-5 px-5">
            <div class="mb-4">
                <h2>Confirm and pay</h2>
                <span>please make the payment, Thank You Sir.</span>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-3">
                        <h6 class="text-uppercase">Payment details</h6>
                        <div class="inputbox mt-3">
                            <input type="text" name="card_name" class="form-control" required="required" />
                            <span>Name on card</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="number" name="card_number" class="form-control" required="required" />
                                    <i class="fa fa-credit-card"></i>
                                    <span>Card Number</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-row">
                                    <div class="inputbox mt-3 mr-2">
                                        <input type="text" name="expire" class="form-control" required="required" />
                                        <span>Expiry</span>
                                    </div>
                                    <div class="inputbox mt-3 mr-2">
                                        <input type="text" name="cvv" class="form-control" required="required" />
                                        <span>CVV</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-4 mb-4">
                        <h6 class="text-uppercase">Billing Address</h6>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control" required="required" />
                                    <span>Street Address</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control" required="required" />
                                    <span>City</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control" required="required" />
                                    <span>State/Province</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control" required="required" />
                                    <span>Zip code</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                    <div class="mt-4 mb-4 d-flex justify-content-between">
                        <span></span>
                        <button type="submit" class="btn btn-primary mx-3 px-5 ">Pay Online</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <br><br>
                        <span>You have to pay</span>

                        <div class="d-flex flex-row align-items-end mb-5 ">
                            <div class="mb-4 ">
                                <h1 class="mb-0 yellow">৳549</h1>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-end mb-1"><br><br><br>
                            <button type="submit" class="btn btn-primary px-4">Cash Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    function requestUser(v_Id) {
    postRequestUser(v_Id, '{{ route('payment.store', ['id' => session('userid')]) }}')
    }
</script>