@extends('layouts.app')

@section('content')

<!-- Start Banner -->
<div class="section inner_page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="full">
                    <h3>Blog</h3>
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
            <div class="col-md-8">
                <div class="full">
                    <!-- Blog Post -->
                    @foreach($posts as $post)
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{env('ADMIN_URL').'/'}}" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{$post->title}}</h2>
                            <p class="card-text">{{substr($post->description, 0, 100)}}...</p>
                            <a href="/blog/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted {{$post->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endforeach
                    {{$posts->links()}}
                    <!-- End Blog Post -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->

<!-- section -->

<!-- end section -->
<br><br><br><br>

<!-- section -->

<!-- end section -->

@endsection()