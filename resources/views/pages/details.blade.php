@extends('layouts.app')

@section('content')

<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Shopping order</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<div class="section layout_padding">
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-7">
                <div style="font-size: 30px">Time Left: <span id="time">0:00:00</span></div>
                <div class="card gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="card-title">{{$order->title}}</h2>
                            </div>
                        </div>

                        @if($order->words)
                        <h6 class="card-subtitle mb-2 text-muted">{{$order->words}} Words</h6>
                        @endif
                        <p class="card-text">{{$order->description}}</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Price: ${{$order->price}}</strong>
                            </div>
                            <div class="col-sm-6 end">
                                <strong class="end">TimeFrame: {{$order->timeframe}} hours</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    timer('{{$order->id}}')
</script>
@endsection