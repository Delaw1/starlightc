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

            <div class="full">
                <!-- Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1 class="mt-4">{{$post->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by
                        <a href="#">Admin</a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p>Posted {{$post->created_at->diffForHumans()}}</p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-fluid rounded" width="900" height="300"  src="{{env('ADMIN_URL')}}admin_content/upload/blog/{{$post->img}}" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p class="lead">{{$post->description}}</p>


                    <hr>

                    <!-- Comments Form -->
                    @if(Auth::Check())
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form action="/submitComment" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="post_id" value="{{$post->id}}" />
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <!-- Single Comment -->
                    @foreach($post->comment as $comment)
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <div onclick="reply('{{$comment->id}}')">
                                <h5 class="mt-0">{{$comment->user->first_name}}</h5>
                                {{$comment->comment}}
                            </div>

                            @foreach($comment->reply as $reply)
                            <div class="media mt-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">{{$reply->user->first_name}}</h5>
                                    {{$reply->reply}}
                                </div>
                            </div>
                            @endforeach
                            @if(Auth::Check())
                            <form action="/submitReply" method="post" id="reply_{{$comment->id}}" style="display: none">
                                {{csrf_field()}}
                                <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                <div class="form-group">
                                    <textarea class="form-control" rows="1" name="reply"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">reply</button>
                            </form>
                            @endif
                        </div>

                    </div>
                    @endforeach



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

@section('scripts')

@endsection