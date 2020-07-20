<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Content</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="/img/logo.png" type="/image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="/css/pogo-slider.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/code.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css" />

    <link rel="stylesheet" href="/css/font-awesome.min.css" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="home" class="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <!-- <div id="preloader">
        <div class="loader">
            <img src="/images/loader.gif" alt="#" />
        </div>
    </div> -->
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="{{ asset('/img/logo.png') }}" width="59px" height="59px" alt="image"></a>
                @guest
                <a id="regMobile" class="btn btn-outline-success" href="/register" type="button">Join</a>
                <a id="regMobile" class="btn btn-outline-success" href="/login" type="button">Login</a>
                @endguest
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="{{ asset('/img/signin5.png') }}" width="39px" height="39px" alt="image" class="saturate">
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li id="terms"><a class="nav-link active" href="/">Home</a></li>
                        <li id="terms"><a class="nav-link" href="/about">About us</a></li>
                        <li id="terms"><a class="nav-link" href="/#services">Services</a></li>
                        @guest
                        <li id="logMobile terms"><a class="nav-link active" style="background:#f2184f;color:#fff;" href="/register">Join</a></li>
                        <li id="logMobile terms"><a class="nav-link active" style="background:#f2184f;color:#fff;" href="/login">Login</a></li>
                        @else
                        <li id="terms"><a class="nav-link" href="/cart">Cart</a></li>
                        <li id="terms"><a class="nav-link" href="/orders">Orders</a></li>
                        <li id="terms"><a class="nav-link" href="/profile">Profile</a></li>
                        <li id="terms"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
                <!-- <div class="search-box">
                    <input type="text" class="search-txt" placeholder="Search">
                    <a class="search-btn">
                        <img src="/images/search_icon.png" alt="#" />
                    </a>
                </div> -->
            </div>
        </nav>
    </header>
    <!-- End header -->


    @yield('content')

    <!-- Start Footer -->
    <footer class="footer-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 margin-bottom_30">
                    <img src="/img/f_logo.png" width="59px" height="79px" alt="#" />
                </div>
                <div class="col-xl-10 white_fonts">
                    <div class="row">
                        <div class="col-md-12 white_fonts margin-bottom_30">
                            <h3>Contact Us</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="full icon">
                                <img src="/images/social1.png">
                            </div>
                            <div class="full white_fonts">
                                <p>Osogbo, Osun State
                                    <br>Nigeria</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="full icon">
                                <img src="/images/social2.png">
                            </div>
                            <div class="full white_fonts">
                                <p>service@starlightc.com
                                    <br>support@starlightc.com</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="full icon">
                                <img src="/images/social3.png">
                            </div>
                            <div class="full white_fonts">
                                <p>+234 808 874 6129
                                    <br>+234 705 888 0763</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="full social_icon margin-top_20">
                                <li id="terms"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li id="terms"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li id="terms"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li id="terms"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 white_fonts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer_blog footer_menu">
                                <h3>Menus</h3>
                                <ul id="terms">
                                    <li id="terms"><a href="#">Home</a></li>
                                    <li id="terms"><a href="#">About Us</a></li>
                                    <li id="terms"><a href="/#services">Services</a></li>
                                    <li id="terms"><a href="/cart">Cart</a></li>
                                    <li id="terms"><a href="/orders">Orders</a></li>
                                    <li id="terms"><a href="/profile">Profile</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </footer>
    <!-- End Footer -->

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="crp">© 2020. All Rights Reserved.</p> 
                    <ul class="bottom_menu">
                        <li id="terms"><a href="/term_of_service">Term of Service</a></li>
                        <li id="terms"><a href="/privacy">Privacy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery.pogo-slider.min.js"></script>
    <script src="/js/slider-index.js"></script>
    <script src="/js/smoothscroll.js"></script>
    <script src="/js/form-validator.min.js"></script>
    <script src="/js/contact-form-script.js"></script>
    <script src="/js/isotope.min.js"></script>
    <script src="/js/images-loded.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/code.js"></script>
    @yield('scripts')
    <script>
        /* counter js */

        (function($) {
            $.fn.countTo = function(options) {
                options = options || {};

                return $(this).each(function() {
                    // set options for current element
                    var settings = $.extend({}, $.fn.countTo.defaults, {
                        from: $(this).data('from'),
                        to: $(this).data('to'),
                        speed: $(this).data('speed'),
                        refreshInterval: $(this).data('refresh-interval'),
                        decimals: $(this).data('decimals')
                    }, options);

                    // how many times to update the value, and how much to increment the value on each update
                    var loops = Math.ceil(settings.speed / settings.refreshInterval),
                        increment = (settings.to - settings.from) / loops;

                    // references & variables that will change with each update
                    var self = this,
                        $self = $(this),
                        loopCount = 0,
                        value = settings.from,
                        data = $self.data('countTo') || {};

                    $self.data('countTo', data);

                    // if an existing interval can be found, clear it first
                    if (data.interval) {
                        clearInterval(data.interval);
                    }
                    data.interval = setInterval(updateTimer, settings.refreshInterval);

                    // initialize the element with the starting value
                    render(value);

                    function updateTimer() {
                        value += increment;
                        loopCount++;

                        render(value);

                        if (typeof(settings.onUpdate) == 'function') {
                            settings.onUpdate.call(self, value);
                        }

                        if (loopCount >= loops) {
                            // remove the interval
                            $self.removeData('countTo');
                            clearInterval(data.interval);
                            value = settings.to;

                            if (typeof(settings.onComplete) == 'function') {
                                settings.onComplete.call(self, value);
                            }
                        }
                    }

                    function render(value) {
                        var formattedValue = settings.formatter.call(self, value, settings);
                        $self.html(formattedValue);
                    }
                });
            };

            $.fn.countTo.defaults = {
                from: 0, // the number the element should start at
                to: 0, // the number the element should end at
                speed: 1000, // how long it should take to count between the target numbers
                refreshInterval: 100, // how often the element should be updated
                decimals: 0, // the number of decimal places to show
                formatter: formatter, // handler for formatting the value before rendering
                onUpdate: null, // callback method for every time the element is updated
                onComplete: null // callback method for when the element finishes updating
            };

            function formatter(value, settings) {
                return value.toFixed(settings.decimals);
            }
        }(jQuery));

        jQuery(function($) {
            // custom formatting example
            $('.count-number').data('countToOptions', {
                formatter: function(value, options) {
                    return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                }
            });

            // start all the timers
            $('.timer').each(count);

            function count(options) {
                var $this = $(this);
                options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                $this.countTo(options);
            }
        });
    </script>
    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+2347025120659", // WhatsApp number
                call_to_action: "Message us", // Call to action
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /GetButton.io widget -->

</body>

</html>