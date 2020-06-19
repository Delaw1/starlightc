@extends('layouts.app')

@section('content')

<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>{{$section->title}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Banner -->

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="heading_main text_align_left">
                        <div class="left">
                            <p class="section_count">01</p>
                        </div>
                        <div class="right">
                            <p class="small_tag">{{$section->title}}</p>
                            <h2><span class="theme_color">LET'S</span> HELP YOU WRITE YOUR CONTENT</h2>
                            @if($section->currency == "cent")
                            <p class="large">Price: {{$section->price}} cent per word</p>
                            @else
                            <p class="large">Price: ${{$section->price}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->


<!-- section -->
<div class="section" style="margin-bottom: 30px"> 
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if($section->currency == "cent")
        <div class="row">
            <div class="col-sm-6">
                <p class="size">Product price: <span class="total_price">$ 0</span></p>
            </div>
            <div class="col-sm-6 end">
                <p class="size-15">Time Frame: <span class="time_frame">0 hours</span></p>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-6">
                <p>Product price: <span class="">$ {{$section->price}}</span></p>
            </div>
            <div class="col-md-6 end">
                <p>Time Frame: <span class="">24 hours</span></p>
            </div>
        </div>
        @endif

        <form method="post" action="/add_to_cart">
            {{ csrf_field() }}
            <div class="form-row">
                <input type="hidden" name="section_id" value="{{$section->id}}" />
                @if($section->currency == "cent")
                <div class="form-group col-md-6">
                    <label for="inputTitle">Title</label>
                    <input name="title" type="text" class="form-control" value="{{ old('title') }}" id="inputTitle" placeholder="Title" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputWords">Number of words</label>
                    <input name="words" type="number" class="form-control word" id="inputWords" value="{{ old('words') }}" placeholder="Number of words" required>
                </div>
                @else
                <div class="form-group col-md-12">
                    <label for="inputTitle">Title</label>
                    <input name="title" type="text" class="form-control" value="{{ old('title') }}" id="inputTitle" placeholder="Title" required>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea name="description" type="text" class="form-control" id="inputDescription" placeholder="Enter more details about the project" required>{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add to cart</button>
        </form>
    </div>
</div>
<!-- end section -->

@if($section->currency == "cent")
@section('scripts')
<script type="text/javascript">
    $(document).ready(() => {
        setInterval(function() {
            $word = document.querySelector(".word").value
            calculatePrice($word, '{{$section->price}}')
        }, 100)
    })
</script>
@endsection
@endif

@endsection