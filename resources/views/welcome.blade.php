@extends('layouts.app')

@section('content')



<!-- Start Banner -->
<div class="ulockd-home-slider">
    <div class="container-fluid">
        <div class="row">
            <div class="pogoSlider" id="js-main-slider">
                <div class="pogoSlider-slide" style="background-image:url(/img/banner-img.png);">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide_text">
                                    <h3>Trusted and<br>Professional Writers</h3>
                                    <br>
                                    <h4><span class="theme_color">25% referral bonus on their first job</span></h4>
                                    <br>
                                    <p>We exude excellence via content</p>
                                    <a class="contact_bt" href="/about">About us</a>
                                </div>
                                <div class="slide_text2">
                                    <h3>Trusted and Professional Writers</h3>
                                    <br>
                                    <h4><span class="theme_color">25% referral bonus on their first job</span></h4>
                                    <br>
                                    <p>We exude excellence via content</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pogoSlider-slide" style="background-image:url(/img/banner-img.png);">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide_text">
                                    <h3>Trusted and<br>Professional Writers</h3>
                                    <br>
                                    <h4><span class="theme_color">25% referral bonus on their first job</span></h4>
                                    <br>
                                    <p>We exude excellence via content</p>
                                    <a class="contact_bt" href="/about">About us</a>
                                </div>
                                <div class="slide_text2">
                                    <h3>Trusted and Professional Writers</h3>
                                    <br>
                                    <h4><span class="theme_color">25% referral bonus on their first job</span></h4>
                                    <br>
                                    <p>We exude excellence via content</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .pogoSlider -->
        </div>
    </div>
</div>
<!-- End Banner -->


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
                            <p class="small_tag">About us</p>
                            <h2><span class="theme_color">WE CAN</span> HELP YOU WRITE YOUR CONTENT</h2>
                            <p class="large">Just in two steps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section dark_bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 text_align_center padding_0">
                <div class="full">
                    <img class="img-responsive" src="img/img-2png.png" alt="#" />
                </div>
            </div>

            <div class="col-lg-6 col-md-12 white_fonts layout_padding padding_left_right">
                <h3 class="small_heading">EVERYTHING<br>YOU NEED IN ONE SOLUTION</h3>
                <p>Are you dying to have an engaging and straight-to-point content on your blogs, web sites and social media pages? Well, you came to the right place.
                    <br><br>
                    We got the technical-know-how in providing an incredible and lasting solution to your many challenges. Kindly look up our services and let us know how we can serve you. With Starlight Premium Content, SEO-content has been made a lot easier.
                    <br><br>
                    Let's do it the professional way.</p>
            </div>
        </div>
    </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="heading_main text_align_left" id="services">
                        <div class="left">
                            <p class="section_count">02</p>
                        </div>
                        <div class="right">
                            <p class="small_tag">SERVICES</p>
                            <h2>Opt for our <span class="theme_color">premium services</span> today. We sure deliver the best</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top_30">
            @foreach($sects as $sect)

            <div class="col-sm-6 col-md-4" onclick="redirect('order/{{$sect->url}}')">
                <div class="service_blog">
                    <div class="service_icons">
                        <img width="75" height="75" src="img/icon-{{$sect->id}}.png" alt="#">
                    </div>
                    <div class="full">
                        <h4>{{$sect->title}}</h4>
                    </div>
                    <div class="full">
                        <p>{{$sect->description}}</p>
                        @if($sect->currency == 'cent')
                        <strong>Price: {{$sect->price}} cent per word </strong>
                        @else
                        <strong>Price: ${{$sect->price}}</strong>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end section -->



<!-- section -->
<div class="section layout_padding dark_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="heading_main text_align_left white_fonts">
                        <div class="left">
                            <p class="section_count">03</p>
                        </div>
                        <div class="right">
                            <h2>Create <span class="theme_color">PERSONALISED Writeup</h2>
                            <p class="large">What we've done</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top_30">
            <div class="col-lg-12 margin-top_30 white_fonts">
                <p>Starlight Premium Content is a leading writing agency in the content writing world. We deliver top-notch contents, ranging from; Guest posts, product description, product review, website review, blog posts, social media content, speeches, among others.</p>
            </div>
            <div class="col-lg-12">
                <div class="full">
                    <a href="/about" class="contact_bt">Read More ></a>
                </div>
            </div>
        </div>
        <div class="row margin-top_30 counter_section">
            <div class="col-sm-12 col-md-4">
                <div class="counter margin-top_30">

                    <h2 class="timer count-title count-number" data-to="23" data-speed="1500"></h2>
                    <p class="count-text">NOMINATIONS</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="counter margin-top_30">

                    <h2 class="timer count-title count-number" data-to="7" data-speed="1500"></h2>
                    <p class="count-text">AWARDS</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="counter margin-top_30">

                    <h2 class="timer count-title count-number" data-to="31" data-speed="1500"></h2>
                    <p class="count-text">AGENCIES</p>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="heading_main text_align_left">
                        <div class="left">
                            <p class="section_count">04</p>
                        </div>
                        <div class="right">
                            <p class="small_tag">Meet Our Team</p>
                            <h2><span class="theme_color">Heads of Department</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top_30">
            <div class="col-lg-12 margin-top_30">
                <div id="team_slider" class="carousel slide" data-ride="carousel">

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                @foreach($writers as $writer)

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="full">
                                        <div class="full team_member_img text_align_center">
                                            <img src="{{ $writer->picture ? env('ADMIN_URL').'/storage/'.$writer->picture : '/assets/images/avatars/1.jpg'}}" alt="#" />
                                            <div class="social_icon_team">
                                                <ul class="social_icon">
                                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="full text_align_center">
                                            <h3>{{ $writer->last_name }} {{ $writer->first_name }}</h3>
                                        </div>
                                        <div class="full text_align_center">
                                            <p>{{ $writer->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">

                                @foreach($writers as $writer)

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="full">
                                        <div class="full team_member_img text_align_center">
                                            <img src="{{ $writer->picture ? env('ADMIN_URL').'/storage/'.$writer->picture : '/assets/images/avatars/1.jpg'}}" alt="#" />
                                            <div class="social_icon_team">
                                                <ul class="social_icon">
                                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="full text_align_center">
                                            <h3>{{ $writer->last_name }} {{ $writer->first_name }}</h3>
                                        </div>
                                        <div class="full text_align_center">
                                            <p>{{ $writer->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="bullets">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#team_slider" data-slide-to="0" class="active"></li>
                            <li data-target="#team_slider" data-slide-to="1"></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="heading_main text_align_left">
                        <div class="left">
                            <p class="section_count">05</p>
                        </div>
                        <div class="right">
                            <p class="small_tag"></p>
                            <h2><span class="theme_color">Our Professional Writers</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top_30">
            <div class="col-lg-12 margin-top_30">
                <div id="team_slider" class="carousel slide" data-ride="carousel">

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                @foreach($writers as $writer)

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="full">
                                        <div class="full team_member_img text_align_center">
                                            <img src="{{ $writer->picture ? env('ADMIN_URL').'/storage/'.$writer->picture : '/assets/images/avatars/1.jpg'}}" alt="#" />

                                        </div>
                                        <div class="full text_align_center">
                                            <h3>{{ $writer->last_name }} {{ $writer->first_name }}</h3>
                                        </div>
                                        <div class="full text_align_center">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">

                                @foreach($writers as $writer)

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="full">
                                        <div class="full team_member_img text_align_center">
                                            <img src="{{ $writer->picture ? env('ADMIN_URL').'/storage/'.$writer->picture : '/assets/images/avatars/1.jpg'}}" alt="#" />

                                        </div>
                                        <div class="full text_align_center">
                                            <h3>{{ $writer->last_name }} {{ $writer->first_name }}</h3>
                                        </div>
                                        <div class="full text_align_center">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="bullets">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#team_slider" data-slide-to="0" class="active"></li>
                            <li data-target="#team_slider" data-slide-to="1"></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- end section -->


@endsection()