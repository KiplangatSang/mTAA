@extends('layouts.app')
@section("content")
<div class="container-fluid">
    <!-- search box nav-->
    <div class="col-md-6 col-xl mx-auto">
        <!--search box nav-->
        <nav class="navbar  justify-content-center p-1 m-2">
            <div class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchbox">
                <button class="btn btn-outline-success my-2 my-sm-0" id="search_button">Search</button>
            </div>
        </nav>
    </div>

    <!--categories and houses  -->
    <div class="mt-3 ">
        <div class="row ">
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
            <!--  houses  -->
            <div class=" col-md col-xl col-lg">
                <div class="row">
                    @foreach ($housedata['houses'] as $house)
                    <div class="house col col-md-4">
                        <div class="card p-1 m-1" style="width: auto; max-width:18rem;">
                            <img class="img-fluid w-100" src="https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $house->type }}</h5>
                                <p>Price <strong>{{ $house->price }} ksh</strong></p>
                                <p>Location <strong>{{ $house->location }}</strong></p>
                                <div class="row bg-dark">
                                    <!-- Images Start -->
                                    <section class="py-2 border-bottom wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 text-center mb-2">
                                                        <ul class="list-inline mb-4" id="portfolio-flters">
                                                            <li class="btn btn-secondary m-1 active" data-filter=".{{ $house->house_id.$house->id }}">All</li>
                                                            <li class="btn btn-secondary m-1 " data-filter=".{{ $house->house_id.$house->id.'first' }}">Inside </li>
                                                            <li class="btn btn-secondary m-1" data-filter=".{{ $house->house_id.$house->id.'second' }}">Outside</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row portfolio-container">
                                                    <div class="col-md-6 mb-4 portfolio-item {{ $house->house_id.$house->id }} {{ $house->house_id.$house->id.'first' }}">
                                                        <div class="position-relative overflow-hidden mb-2">
                                                            <img class="img-fluid w-100" src="{{  url('/assets/images_view/img/portfolio-2.png') }}" alt="">
                                                            <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                                <a href="{{ url('/assets/images_view/img/portfolio-2.png')}}" data-lightbox="portfolio{{ $house->id }}">
                                                                    <i class="bi bi-plus text-light"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4 portfolio-item {{ $house->house_id.$house->id }} {{ $house->house_id.$house->id.'first' }}">
                                                        <div class="position-relative overflow-hidden mb-2">
                                                            <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-2.png')}}" alt="">
                                                            <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                                <a href="{{ url('/assets/images_view/img/portfolio-2.png')}}" data-lightbox="portfolio{{ $house->id }}">
                                                                    <i class="bi bi-plus text-light"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4 portfolio-item {{ $house->house_id.$house->id }} {{ $house->house_id.$house->id.'first' }}">
                                                        <div class="position-relative overflow-hidden mb-2">
                                                            <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-3.jpg')}}" alt="">
                                                            <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                                <a href="{{ url('/assets/images_view/img/portfolio-3.jpg')}}" data-lightbox="portfolio{{ $house->id }}">
                                                                    <i class="bi bi-plus text-light"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4 portfolio-item {{ $house->house_id.$house->id }} {{ $house->house_id.$house->id.'second' }}">
                                                        <div class="position-relative overflow-hidden mb-2">
                                                            <img class="img-fluid w-100" src="{{ url('/assets/images_view/img/portfolio-4.jpg')}}" alt="">
                                                            <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                                <a href="{{ url('/assets/images_view/img/portfolio-4.jpg')}}" data-lightbox="portfolio{{ $house->id }}">
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
                                <div class="col mt-2">
                                    <a href="{{ route('landlord.houses.delete',['id'=>$house->id]) }}" class="btn btn-outline-danger float-left" type="button"><Strong>Delete</Strong></a>
                                    <a href="{{ route('landlord.houses.show',['id'=>$house->id]) }}" class="btn btn-outline-success float-right" type="button"><Strong>View</Strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{--  <div class="row mx-auto m-1 p-2">
                    {{ $homedata['houses']->links() }}
                </div>  --}}
            </div>
        </div>
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
