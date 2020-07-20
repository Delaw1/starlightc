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
                        
                        <a class="btn btn-success btn-lg btn-block" href="/paynow" role="button">Proceed to checkout</a>
                    </div>
                </div>
            </div>

        <br />
        <law />

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

@endsection