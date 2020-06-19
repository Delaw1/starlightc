@extends('layouts.app')

@section('content')
<?php
if (Auth::User()->account_number == null) {
    $state = "Add";
} else {
    $state = "Edit";
}
?>
<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>{{ $state }} Bank details</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<div class="container layout_padding">
    <div class="row justify-content-center">
        <div class="sidebar2 col-sm-2 col-md-2">
            <a href="/profile">Profile</a>
            <a href="/edit_profile">Edit Profile</a>
            <a href="/change_password">Change Password</a>
            <a href="/withdrawal">Withdraw</a>
            <a class="active" href="#">@if(Auth::User()->account_number == null) Add @else Edit @endif Bank Details</a>
        </div>
        <div class="col-md-8">
            @include('includes.success')
            @include('includes.error')
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="/bank_details">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Enter Passowrd</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>

                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account_name" class="col-md-4 col-form-label text-md-right">Account Name</label>

                            <div class="col-md-6">
                                <input id="account_name" type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name" value="{{Auth::User()->account_name}}" required autofocus>

                                @error('account_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">Account Number</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{Auth::User()->account_number}}" required>

                                @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">Bank Name</label>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" required value="{{Auth::User()->bank_name}}" autofocus>

                                @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ $state }} details
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection