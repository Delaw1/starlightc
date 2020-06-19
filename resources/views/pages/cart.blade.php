@extends('layouts.app')

@section('content')
<?php
$total_price = 0;
foreach ($carts as $cart) {
    $total_price += $cart->price;
}
?>
<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Shopping Cart</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<div class="section layout_padding">
    <div class="container">
        @isset($error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endisset
        <div class="row">
            @if(count($carts) > 0)
            <div class="col-md-7">
                @foreach($carts as $cart)
                <div class="card gray" onmouseover="addTimes('{{$loop->index}}')" onmouseout="removeTimes('{{$loop->index}}')">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="card-title">{{$cart->title}}</h2>
                            </div>
                            <div class="col-md-2 end times hidden"><a href="/remove/{{$cart->id}}">&times;</a></div>
                        </div>

                        @if($cart->words)
                        <h6 class="card-subtitle mb-2 text-muted">{{$cart->words}} Words</h6>
                        @endif
                        <p class="card-text">{{$cart->description}}</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Price: ${{$cart->price}}</strong>
                            </div>
                            <div class="col-sm-6 end">
                                <strong class="end">TimeFrame: {{$cart->timeframe}} hours</strong>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-5">
                <div class="card" style="margin-top: 20px; background-color: #343a40;">
                    <div class="card-body white">
                        <p class="size">SUMMARY</p>
                        <hr class="hr">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="text-muted">SUBTOTAL</h6>
                                <p>VAT</p>
                            </div>
                            <div class="col-sm-6 end">
                                <p>${{$total_price}}</p>
                                <p>$0</p>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="row size">
                            <div class="col-md-6">
                                <p class="size">TOTAL</p>
                            </div>
                            <div class="col-md-6 end">
                                <p class="size">${{$total_price}}</p>
                            </div>
                        </div>
                        <a class="btn btn-success btn-lg btn-block payment" role="button">Proceed to checkout</a>
                    </div>
                </div>
            </div>

        <br />
        <law />

            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                <div class="row" style="margin-bottom:40px;">
                    <div class="col-md-8 col-md-offset-2">
                        <p>
                            <div>
                                Lagos Eyo Print Tee Shirt
                                ₦ 2,950
                            </div>
                        </p>
                        <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
                        <input type="hidden" name="orderID" value="345">
                        <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
                        <input type="hidden" name="quantity" value="3">
                        <input type="hidden" name="currency" value="NGN">
                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}"> {{-- For other necessary things you want to add to your payload. it is optional though --}}
                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                        {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                        <p>
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                            </button>
                        </p>
                    </div>
                </div>
            </form>

            @else
            <div>
                <h2>Your cart is empty</h2>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_EQnbVSlCLwFuYy2tHssHcQd200TAc3cQ47');
    $('.payment').on('click', function() {
        stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as parameter here
            // instead of the placeholder.
            sessionId: '{{$id}}'
        }).then(function(result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
    })
</script>
@endsection