@extends('layouts.app')

@section('content')

<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Withdrawal Request</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row justify-content-center">
        <div class="sidebar2 col-sm-2 col-md-2">
            <a href="/profile">Profile</a>
            <a href="/edit_profile">Edit Profile</a>
            <a href="/change_password">Change Password</a>
            <a class="active" href="#">Withdraw</a>
            <a href="/bank_details">@if(Auth::User()->account_number == null) Add @else Edit @endif Bank Details</a>
        </div>
            <div class="col-md-8">
                @include('includes.success')
                @include('includes.error')

                <div>
                    Balance: $ {{ Auth::User()->wallet }}
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/withdrawal">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Amount</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" required autofocus>

                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if(Auth::User()->wallet == 0)
                                    <span style="color: red" role="alert">
                                        <strong>* You have a low balance</strong>
                                    </span>
                                    @endif
                                    <span style="color: red" role="alert" >
                                        <strong id="validateamount"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="withdraw" type="submit" class="btn btn-primary btn-lg btn-block">
                                        Withdraw
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->

@endsection

@section('scripts')
@if(Auth::User()->wallet == 0)
<script>
    $(document).ready(() => {
        document.querySelector('#withdraw').disabled = true
        document.querySelector('#amount').disabled = true
    })
</script>
@else 
<script>
    $(document).ready(() => {
        setInterval(function() {
            var amount = document.querySelector("#amount").value
            var balance = "{{Auth::User()->wallet}}"
            validateamount(parseFloat(balance), amount)
        }, 100)
    })
</script>
@endif
@endsection
