@extends('layouts.welcome')
@section("content")
<div class="container-fluid">
    <div class="content">
        <!--location top nav -->
        <div class="col-md-6 col-xl mx-auto show-content">
            <nav class="navbar  justify-content-between">
                <div class="col">
                    <a class="app-nav__item bg-white text-dark" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">Country</a>
                    <form action="{{ route('search-houses') }}" method="POST" id="country_select_form">
                        @csrf
                        <select disabled class="form-control" name="country" id="country_select" onchange="
                    event.preventDefault();
                                                                                        document.getElementById('country_select_form').submit();">
                            <optgroup label="Select country">
                                @foreach ($data['countries'] as $country)
                                @if ($country->name == "KENYA")
                                <option value="{{ $country->name}}">{{ $country->name}}</option>
                                @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </form>
                </div>
                <div class="col">
                    <a class="app-nav__item bg-white text-dark" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        County</a>

                    <form action="{{ route('search-houses') }}" method="POST" id="county_select_form">
                        @csrf
                        <select class="form-control" name="county" id="county_select" onchange="
                    event.preventDefault();
                                                                                        document.getElementById('county_select_form').submit();">
                            <optgroup label="Select county">
                                @foreach ($data['counties'] as $county)
                                <option value="{{ $county->name}}">{{ $county->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </form>

                </div>
                <div class="col">
                    <!-- User Menu-->
                    <a class="app-nav__item bg-white text-dark" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        City</a>
                    <form action="{{ route('search-houses') }}" method="POST" id="city_select_form">
                        @csrf
                        <select class="form-control" name="city" id="city_select" onchange="
                    event.preventDefault();
                                                                                        document.getElementById('city_select_form').submit();">
                            <optgroup label="Select city">
                                @foreach ($data['counties'] as $county)
                                <option value="{{ $county->headquaters}}">{{ $county->headquaters}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </form>
                </div>
                <div class="col">
                    <a class="app-nav__item bg-white text-dark" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        Town</a>

                    <form action="{{ route('search-houses') }}" method="POST" id="town_select_form">
                        @csrf
                        <select class="form-control" name="town" id="town_select" onchange="
                    event.preventDefault();
                                                                                        document.getElementById('town_select_form').submit();">
                            <optgroup label="Select town">
                                @foreach ($data['counties'] as $county)
                                <option value="{{ $county->headquaters}}">{{ $county->headquaters}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </form>
                </div>
            </nav>
        </div>

        <!--categories and house section -->
        <div class="mt-3 mb-5">
            <div class="row">
                <!--categories  section -->
                <div class="col-md-6 col-xl-3 m-2">
                    @foreach ($data['availableHouseCategories'] as $key=>$category)
                    <div class="row">
                        <a class="text-dark" onclick="sendform('category'+ @json($key))" id="category{{ $key }}">
                            {{ $category->type}}
                        </a>
                    </div>
                    <hr class="new-1">
                    @endforeach
                    <form action="{{ route('search-houses') }}" id="type_form" method="POST" class="d-none">
                        @csrf
                        <input type="text" name="type" value="" id="type_input">
                    </form>
                </div>
                <!-- house section -->
                <div class=" col-md col-xl col-lg">
                    <!--buttons-->
                    <div class="row">
                        <div class="col">
                            <div class="d-grid gap-2 mt-1">
                                <a class="btn btn-success" id="paybtn" type="button"><Strong>Pay now</Strong></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid gap-2 mt-1">
                                <a href="{{ route('home') }}" class="btn btn-danger" type="button"><Strong>Cancel</Strong></a>
                            </div>
                        </div>

                    </div>
                    <div class="row m-2 p-2 tile">
                        <div class="house col col-md-6 col-xl-6">
                            <div class="card p-1 m-1" style="width: auto; max-width:18rem;">
                                <img class="img-fluid w-100" src="https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $housedata['house']->house->type }}</h5>
                                    <p>Price <strong>{{ $housedata['house']->house->price }} ksh</strong></p>
                                    <p>Location <strong>{{ $housedata['house']->house->location }}</strong></p>

                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6 col-xl-6 ">
                            <div class="header">
                                <h2> Pictures of the house</h2>
                            </div>
                            <div class="row bg-dark">
                                <!-- Images Start -->
                                <section class="py-2 border-bottom wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 text-center mb-2">
                                                    <ul class="list-inline mb-4" id="portfolio-flters">
                                                        <li class="btn btn-secondary m-1 active" data-filter=".{{ $housedata['house']->house_id.$housedata['house']->id }}">All</li>
                                                        <li class="btn btn-secondary m-1 " data-filter=".{{ $housedata['house']->house_id.$housedata['house']->id.'first' }}">Inside </li>
                                                        <li class="btn btn-secondary m-1" data-filter=".{{ $housedata['house']->house_id.$housedata['house']->id.'second' }}">Outside</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row portfolio-container">
                                                <div class="col-md-6 mb-4 portfolio-item {{ $housedata['house']->house_id.$housedata['house']->id }} {{ $housedata['house']->house_id.$housedata['house']->id.'first' }}">
                                                    <div class="position-relative overflow-hidden mb-2">
                                                        <img class="img-fluid w-100" src="{{  url('/assets/images_view/img/portfolio-2.png') }}" alt="">
                                                        <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                            <a href="{{ url('/assets/images_view/img/portfolio-2.png')}}" data-lightbox="portfolio{{ $housedata['house']->id }}">
                                                                <i class="bi bi-plus text-light"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 portfolio-item {{ $housedata['house']->house_id.$housedata['house']->id }} {{ $housedata['house']->house_id.$housedata['house']->id.'first' }}">
                                                    <div class="position-relative overflow-hidden mb-2">
                                                        <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-2.png')}}" alt="">
                                                        <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                            <a href="{{ url('/assets/images_view/img/portfolio-2.png')}}" data-lightbox="portfolio{{ $housedata['house']->id }}">
                                                                <i class="bi bi-plus text-light"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 portfolio-item {{ $housedata['house']->house_id.$housedata['house']->id }} {{ $housedata['house']->house_id.$housedata['house']->id.'first' }}">
                                                    <div class="position-relative overflow-hidden mb-2">
                                                        <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-3.jpg')}}" alt="">
                                                        <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                            <a href="{{ url('/assets/images_view/img/portfolio-3.jpg')}}" data-lightbox="portfolio{{ $housedata['house']->id }}">
                                                                <i class="bi bi-plus text-light"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 portfolio-item {{ $housedata['house']->house_id.$housedata['house']->id }} {{ $housedata['house']->house_id.$housedata['house']->id.'second' }}">
                                                    <div class="position-relative overflow-hidden mb-2">
                                                        <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-4.jpg')}}" alt="">
                                                        <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                            <a href="{{ url('/assets/images_view/img/portfolio-4.jpg')}}" data-lightbox="portfolio{{ $housedata['house']->id }}">
                                                                <i class="bi bi-plus text-light"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Images End -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--payment form -->
    <div class="row d-flex justify-content-center mx-auto fixed-top mt-5" id="paymentform">
        <div class="col-md-4 col-xl-4 payment-popup " id="paymentSection">
            <form action="/client/transactions/deposit/store" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                @include('inc.paymentform')
            </form>
        </div>
        {{-- <div class="col-md-4 col-xl-4  bg-light payment-popup" id="load">
            @include('inc.loading')
        </div>  --}}
    </div>
    <script>
        $("#searchbox").keyup(function() {
            let txt = this.value;
            searchfilter(txt)
        });

        $("#search_button").click(function() {
            let txt = $("#searchbox").value;
            searchfilter(txt)
        });

        function searchfilter(txt) {
            $(".house").hide();
            $(".house").each(function() {
                console.log($(this).text().toUpperCase().indexOf(txt.toUpperCase()));
                if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        function sendform(key) {

            var type = $("#" + key).text();
            $("#type_input").val(type);
            document.getElementById('type_form').submit();
        }

    </script>
</div>
@endsection
