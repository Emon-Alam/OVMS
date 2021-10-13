@extends('layout')
@section('content')

<script src="https://use.fontawesome.com/a6f0361695.js"></script>
<div class="container top-container">

    <link rel="stylesheet" href="{{ asset('assets/css/review.css') }}" />
    <h2 id="fh2">WE APPRECIATE YOUR REVIEW!</h2>
    <h6 id="fh6">Your review will help us to improve our volunteer services, and customer services.</h6>

    <form id="feedback" class="w-75 m-auto" method="post" action="{{route('review.store')}}">
        @csrf

        <div class="pinfo">Your personal info</div>

        <div class="form-group">
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input name="u_name" class="form-control" type="text" value="{{ session('username') }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input name="u_email" type="text" class="form-control" value="{{session('username')}}">
                </div>
            </div>
        </div>
        <div class="pinfo">Rate our overall services.</div>


        <div class="form-group">
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-heart"></i></span>
                    <select class="form-control" name="rating" id="rate">
                        <option value="1star">1</option>
                        <option value="2stars">2</option>
                        <option value="3stars">3</option>
                        <option value="4stars">4</option>
                        <option value="5stars">5</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="pinfo">Write your feedback.</div>


        <div class="form-group">
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <textarea name="details" class="form-control" id="review" rows="3"></textarea>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
</div>

@endsection