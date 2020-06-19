@extends('layouts.app')

@section('content')
<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Change Password</h3>
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
            <a class="active" href="#">Change Password</a>
            <a href="/withdrawal">Withdraw</a>
            <a href="/bank_details">@if(Auth::User()->account_number == null) Add @else Edit @endif Bank Details</a>
        </div>
        <div class="col-md-8">
            @include('includes.success')
            @include('includes.error')
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="/change_password">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Current Passowrd</label>

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
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new_password" autofocus>

                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm new password</label>

                            <div class="col-md-6">
                                <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required>

                                @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Change Password
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