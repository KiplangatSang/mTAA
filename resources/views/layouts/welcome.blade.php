<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MtAA') }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">  --}}



    {{-- images zooming  --}}
    <!-- Google Web Fonts -->

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assets/images_view/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/images_view/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/images_view/lib/animate/animate.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/images_view/css/style.css')}}" rel="stylesheet">

    <!--//from app <div class="blade"></div> -->
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary " style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only text-warning">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <div>
        <nav class="navbar navbar-expand-md navbar-inverse shadow-sm sticky-top p-2">
            <div class="container-fluid ">
                <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                    <div class="p-2"><img src="https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png" style="height:35px;border-right:1px solid #000 " class="pr-3"></div>
                    <div class="pl-1">
                        <h3><strong><a class="text-warning" href="{{ route('welcome') }}">{{ config("app.name") }}</a></strong></h3>
                        <h6><small>We make it easier than yesterday</small></h6>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Search <i class="fa fa-search"></i> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right px-2" aria-labelledby="navbarDropdown">
                                <form class="form-inline  ">
                                    <input class="form-control mx-auto p-3" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-info  mt-2" type="submit">Search</button>
                                </form>
                                <ul class="list-group mt-2">
                                    <li class="list-group-item disabled text-danger">Your Recent Searches</li>
                                    @foreach ($data['search_history'] as $key => $search)
                                    <li class="list-group-item"> <a href="{{ route($key) }}">{{ $search }}</a> </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="https://mtaawebsite.storms.co.ke/FAQS">FAQs <i class="fa fa-map-marker"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://mtaawebsite.storms.co.ke/">About <i class="fa fa-clock-o"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('help') }}"><span class="caret">Help</span> <i class="fa fa-info-circle"></i></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username ?? 'Guest' }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right text-white" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
																																																																									document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="main">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    <!-- Remove the container if you want to extend the Footer to full width. -->
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white mt-3" style="background-color: #1c2331">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4  bg-secondary">
            <!-- Left -->
            <div class="mx-auto p-2">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x  fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x  fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x  fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x  fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fa fa-2x  fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">{{ config("app.name") }}</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            {{ config("app.name") }} is a retail space application that would
                            help you find your rental home, shop or office easily. You can also talk with the landlords conviniently through our app
                            without a strain. Welcome to MtAA for an awesome expirience.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white">House Posting</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Office spaces</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Retail consultancy</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Rentals management and consultancy</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Loans </a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        @foreach ($data['search_history'] as $key=>$link)
                        <p>
                            <a href="{{ route($key) }}" class="text-white">{{ $link }}</a>
                        </p>
                        @endforeach

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fa fa-map-marker mr-3"></i> Nairobi, Kenya , Nairobi County</p>
                        <p><i class="fa fa-envelope mr-3"></i>{{ config("app.name") }}@gmail.com</p>
                        <p><i class="fa fa-phone mr-3"></i> +254 713 120038</p>
                        <p><i class="fa fa-print mr-3"></i> +254 713 120038</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">{{ config("app.name") }}.com</a>

            <!-- Copyright -->
        </div>
    </footer>
    <!--End Footer -->

    <!--Scripts-->
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>

    {{-- date picker --}}
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>


    <script type="text/javascript">
        $('#sampleTable').DataTable();

    </script>


    <script>
        $(function() {
            $("#switch").click(function() {
                $(".table").toggleClass("table-dark");
                $(".tile").toggleClass("bg-dark");
                // $(".row").toggleClass("bg-dark");
                // $(".app-title").toggleClass("bg-dark");
                // $(".btn").toggleClass("btn-dark");


            });
        });

    </script>
    <!-- downloading file -->
    <script>
        function down_file(url, name) {
            var a = $("<a>")
                .attr("href", url)
                .attr("download", name)
                .appendTo("body");
            a[0].click();
            a.remove();
        }

    </script>

    {{-- Zoom scripts  --}}

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/assets/images_view/lib/wow/wow.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/typed/typed.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/easing/easing.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{ url('/assets/images_view/lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/images_view/js/main.js')}}">
    </script>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>

</body>
</html>
