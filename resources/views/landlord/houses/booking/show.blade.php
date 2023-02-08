@extends('layouts.app')
@section("content")
<div class="container-fluid">
    <div class="content">

        <!--payment  and house section -->
        <div class="mt-3 mb-5">
            <div class="row">
                <!--payment  section -->
                <div class="col-md-6 col-xl-4 m-2">
                    <div class="tile mt-5">
                        <div class="d-flex justify-content-center">
                            <h2 class="tile-title">Payment</h2>
                        </div>

                        <div class="row m-1">
                            <div class="col">
                                <p class="m-2"> Payment Status</p>
                            </div>
                            <div class="col">
                                <h2><span class="badge badge-success">Paid</span></h2>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col">
                                <p class="m-2"> Paid Amount</p>
                            </div>
                            <div class="col">
                                <h4>ksh 30000</h4>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col">
                                <p class="m-2"> Gateway</p>
                            </div>
                            <div class="col">
                                <h4>DukaVerse</h4>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col">
                                <p class="m-2">Account</p>
                            </div>
                            <div class="col">
                                <h2><span class="badge badge-dark">DVR14573</span></h2>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col">
                                <p>Reference</p>
                            </div>
                            <div class="col">
                                <p>GDJSKSEJSIIS4</span></p>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col">
                                <p class="m-2">Status</p>
                            </div>
                            <div class="col">
                                <h2><span class="badge badge-warning">Hold</span></h2>
                            </div>
                        </div>
                        <br>
                        <div class="row mx-auto d-flex justify-content-center m-2">
                            <div class="d-grid gap-2  m-1">
                                <a href="#" class="btn btn-dark" onclick="event.preventDefault(); document.getElementById('payment_reverse_form').submit();" type="button"><Strong>Refund this payment</Strong></a>
                            </div>
                            <form action="{{ route('landlord.payment.reverse',['house_id'=>$housedata['house']->id]) }}" id="payment_reverse_form" method="POST" class="d-none">
                                @csrf
                                <input type="text" name="payment_ref" value="{{ 'payment_ref' }}">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- house section -->
                <div class=" col-md col-xl col-lg">
                    <!--buttons-->
                    <div class="row">
                        <div class=" row mx-auto">
                            <div class="d-grid gap-2 mt-1">
                                <a href="#" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('tenant_accept_form').submit();" type="button"><Strong>Accept as tenant</Strong></a>
                                <form action="{{ route('landlord.houses.tenant.store',['house_id'=>$housedata['house']->id,'tenant_id'=>$housedata['house']->id]) }}" id="tenant_accept_form" method="POST" class="d-none">
                                    @csrf
                                    <input type="text" name="payment_ref" value="{{ 'payment_ref' }}">
                                </form>
                            </div>
                            <div class="d-grid gap-2 m-1">
                                <a href="{{ route('landlord.houses.tenant.requet-payment',['house_id'=>$housedata['house']->id,'tenant_id'=>$housedata['house']->id]) }}" class="btn btn-info"  type="button"><Strong>Ask for payment</Strong></a>
                            </div>
                            <div class="d-grid gap-2 m-1">
                                <a href="#" class="btn btn-dark" onclick="sendhouse_book_form()" type="button"><Strong>Send a message</Strong></a>
                            </div>
                            <div class="d-grid gap-2 mt-1">
                                <a href="{{ route('welcome') }}" class="btn btn-danger" type="button"><Strong>Cancel Request</Strong></a>
                            </div>
                            <form action="{{ route('houses.book.store') }}" id="house_book_form" method="POST" class="d-none">
                                @csrf
                                <input type="text" name="house" value="{{ $housedata['house']->id }}">
                            </form>

                        </div>


                    </div>
                    <div class="row m-2 p-2 tile">
                        <div class="house col col-md-6 col-xl-6">
                            <div class="card p-1 m-1" style="width: auto; max-width:18rem;">
                                <img class="img-fluid w-100" src="https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $housedata['house']->type }}</h5>
                                    <p>Price <strong>{{ $housedata['house']->price }} ksh</strong></p>
                                    <p>Location <strong>{{ $housedata['house']->location }}</strong></p>

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


        function sendhouse_book_form() {
            event.preventDefault();
            document.getElementById('house_book_form').submit();
        }


        function sendform(key) {

            var type = $("#" + key).text();
            $("#type_input").val(type);
            document.getElementById('type_form').submit();
        }

    </script>
</div>
@endsection
