@extends('layouts.app')

@section('content')

<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<!-- section -->
<div class="section layout_padding ">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="sidebar2 col-sm-2 col-md-2">
                            <a class="active" href="#">Profile</a>
                            <a href="/edit_profile">Edit Profile</a>
                            <a href="/change_password">Change Password</a>
                            <a href="/withdrawal">Withdraw</a>
                            <a href="/bank_details">@if(Auth::User()->account_number == null) Add @else Edit @endif Bank Details</a>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <img src="/assets/images/avatars/2.jpg" height="220px" alt="" class="img-rounded img-responsive" />
                        </div>
                        <div class="col-sm-4 col-md-7">
                            <h4>{{ Auth::User()->last_name}} {{ Auth::User()->first_name}}</h4>
                            <small><cite title="username">{{ Auth::User()->username}}<i class="glyphicon glyphicon-map-marker">
                                    </i></cite></small>
                            <p>
                                <i class="glyphicon glyphicon-envelope"></i>{{ Auth::User()->email}}
                                <br />
                                <i class="glyphicon glyphicon-globe"></i>{{ count($orders) }} orders completed
                                <br />
                            </p>
                            <?php $ref = env('APP_URL') . "/register?referral=" . Auth::User()->referralcode ?>
                            <p>Wallet: $ {{ Auth::User()->wallet }} </p>
                            <p>Referral link: {{ env('APP_URL')}}/register?referral={{ Auth::User()->referralcode}} 
                                <img src="/img/copy.png" width="27px" onclick="copy('{{$ref}}')" /></p>

                            <!-- Split button -->
                            <!-- <button onclick="redirect('/edit_profile')" class="btn btn-primary">Edit Profile</button>
                            <button onclick="redirect('/change_password')" class="btn btn-primary">Change Password</button>
                            <button onclick="redirect('/bank_details')" class="btn btn-primary">@if(Auth::User()->account_number == null) Add @else Edit @endif Bank Details</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section dark_bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 text_align_center padding_0">
                <div class="full">
                    <img class="img-responsive" src="/img/img-2png.png" alt="#" />
                </div>

            </div>

            <div class="col-lg-6 col-md-12 white_fonts layout_padding padding_left_right">
                <h3 class="small_heading">EVERYTHING<br>YOU NEED IN ONE SOLUTION</h3>
                <p>Starlight Premium Content is a leading writing agency in the content writing world. We deliver top-notch contents, ranging from; Guest posts, product description, product review, website review, blog posts, social media content, speeches, among others.

                    With our outstanding team of writers, you sure will be served high-quality contents that hit your targeted audience right in the heart.</p>
            </div>
        </div>
    </div>
</div>
<!-- end section -->




@endsection()