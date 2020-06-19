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
        @include('includes.success')
        @include('includes.error')
        <div class="row">
            <div class="col-md-7">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link {{ $active_unassigned }}" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Active</a>
                        <!-- <a class="nav-item nav-link {{ $active_assigned }}" id="nav-assigned-tab" data-toggle="tab" href="#nav-assigned" role="tab" aria-controls="nav-assigned" aria-selected="false">Assigned Orders</a> -->
                        <a class="nav-item nav-link {{ $active_submitted }}" id="nav-approve-tab" data-toggle="tab" href="#nav-approve" role="tab" aria-controls="nav-approve" aria-selected="false">Awaiting Approval</a>
                        <a class="nav-item nav-link {{ $active_completed }}" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Completed</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show {{ $active_unassigned }}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @if(count($orders) != 0)
                        @foreach($orders as $order) 
                        <div class="card gray pointer" onclick="redirect('/orders/{{$order['id']}}')">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h2 class="card-title">{{$order['title']}}</h2>
                                    </div>
                                </div>

                                @if($order['words'])
                                <h6 class="card-subtitle mb-2 text-muted">{{$order['words']}} Words</h6>
                                @endif
                                <p class="card-text">{{$order['description']}}</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>Price: ${{$order['price']}}</strong>
                                    </div>
                                    <div class="col-sm-6 end">
                                        <strong class="end">TimeFrame: {{$order['timeframe']}} hours</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $orders->links() }}
                        @else
                        <div class="layout_padding">
                            <h3>No active order</h3>
                        </div>
                        @endif
                    </div>
                    <!-- <div class="tab-pane fade show {{ $active_assigned }}" id="nav-assigned" role="tabpanel" aria-labelledby="nav-assigned-tab">
                        @if(count($assigned) != 0)
                        @foreach($assigned as $order)
                        <div class="card gray pointer" onclick="redirect('/orders/{{$order['id']}}')">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h2 class="card-title">{{$order['title']}}</h2>
                                    </div>
                                </div>

                                @if($order['words'])
                                <h6 class="card-subtitle mb-2 text-muted">{{$order['words']}} Words</h6>
                                @endif
                                <p class="card-text">{{$order['description']}}</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>Price: ${{$order['price']}}</strong>
                                    </div>
                                    <div class="col-sm-6 end">
                                        <strong class="end">TimeFrame: {{$order['timeframe']}} hours</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $assigned->links() }}
                        @else
                        <div class="layout_padding">
                            <h3>No Assigned order</h3>
                        </div>
                        @endif
                    </div> -->
                    <div class="tab-pane fade show {{ $active_submitted }}" id="nav-approve" role="tabpanel" aria-labelledby="nav-approve-tab">
                        @if(count($submitted) != 0)
                        @foreach($submitted as $order)
                        <div class="card gray pointer" onclick="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h2 class="card-title">{{$order['title']}}</h2>
                                    </div>
                                </div>

                                @if($order['words'])
                                <h6 class="card-subtitle mb-2 text-muted">{{$order['words']}} Words</h6>
                                @endif
                                <p class="card-text">{{$order['description']}}</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>Price: ${{$order['price']}}</strong>
                                    </div>
                                    <div class="col-sm-6 end">
                                        <strong class="end">TimeFrame: {{$order['timeframe']}} hours</strong>
                                        <a href="/approve/{{$order['id']}}" class="btn btn-info">Approve</a>
                                        <a href="/storage/{{$order['filepath']}}" download="{{$order['title']}}"><i class="fa fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $completed->links() }}
                        @else
                        <div class="layout_padding" >
                            <h3>No Project Awaiting approval</h3>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade show {{ $active_completed }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @if(count($completed) != 0)
                        @foreach($completed as $order)
                        <div class="card gray pointer" onclick="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h2 class="card-title">{{$order['title']}}</h2>
                                    </div>
                                </div>

                                @if($order['words'])
                                <h6 class="card-subtitle mb-2 text-muted">{{$order['words']}} Words</h6>
                                @endif
                                <p class="card-text">{{$order['description']}}</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>Price: ${{$order['price']}}</strong>
                                    </div>
                                    <div class="col-sm-6 end">
                                        <strong class="end">TimeFrame: {{$order['timeframe']}} hours</strong>
                                        <a href="/storage/{{$order['filepath']}}" download="{{$order['title']}}"><i class="fa fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $completed->links() }}
                        @else
                        <div class="layout_padding">
                            <h3>No completed order</h3>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-5">

            </div>
        </div>
    </div>
</div>

@endsection