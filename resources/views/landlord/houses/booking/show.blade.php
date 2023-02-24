@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="content">
        <div class="row">
            <div class="col-md col-xl col-lg">
                <!--user section-->
                @if($housedata['house']->payments)
                <!--paid bookings section-->
                @foreach ($housedata['house']->payments as $payment)
                <div class="container-fluid">
                    @foreach ($housedata['house']->booked as $booking)
                    <div class="tile">
                        <div class="tile-title row">
                            This user has already booked and paid
                        </div>
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-6 col-xl">
                                    <p>Name : {{$payment->payable->username }}</p>
                                    <p>Email : {{$payment->payable->email }}</p>
                                    <p>Contact : {{$payment->payable->phoneno}}</p>
                                </div>
                                <div class="col-md-6 col-xl">
                                    <p>Paid : ksh{{$payment->amount}}</p>
                                    <p>Gateway : {{$payment->gateway }}</p>
                                    <p>Status : @if ($payment->status == true)
                                        <span class="badge badge-warning">Processed</span>
                                        @else
                                        <span class="badge badge-warning">Money on Hold</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!--buttons-->
                            <div class="row mx-auto">
                                <div class="d-grid gap-2 mt-1">
                                    <a href="#" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('tenant_accept_form').submit();" type="button"><Strong>Accept as tenant</Strong></a>
                                    <form action="{{ route('landlord.houses.tenant.store', ['house_id' => $housedata['house']->id, 'tenant_id' => $housedata['house']->id]) }}" id="tenant_accept_form" method="POST" class="d-none">
                                        @csrf
                                        <input type="text" name="payment_ref" value="{{ 'payment_ref' }}">
                                    </form>
                                </div>
                                <div class="d-grid gap-2 m-1">
                                    <a href="{{ route('landlord.payments.show', ['payment' => $payment->id]) }}" class="btn btn-info" type="button"><Strong>View payment</Strong></a>
                                </div>
                                <div class="d-grid gap-2 m-1">
                                    <a href="#" class="btn btn-dark" onclick="sendhouse_book_form()" type="button"><Strong>Send a message</Strong></a>
                                </div>
                                <div class="d-grid gap-2 mt-1">
                                    <a href="{{ route('welcome') }}" class="btn btn-danger" type="button"><Strong>Cancel
                                            Request</Strong></a>
                                </div>
                                <form action="{{ route('houses.book.store') }}" id="house_book_form" method="POST" class="d-none">
                                    @csrf
                                    <input type="text" name="house" value="{{ $housedata['house']->id }}">
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <!--end paid bookings section-->
                @else
                <!--unpaid  bookings section-->
                <div class="container-fluid">
                    @foreach ($housedata['house']->booked as $booking)
                    <div class="tile">
                        <div class="tile-title">
                            <p>Name : {{$booking->bookable->username }}</p>
                            <p>Email : {{$booking->bookable->email }}</p>
                            <p>Contact : {{$booking->bookable->phoneno}}</p>
                        </div>
                        <div class="tile-body row">
                            <!--buttons-->
                            <div class="row mx-auto">
                                <div class="d-grid gap-2 mt-1">
                                    <a href="#" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('tenant_accept_form').submit();" type="button"><Strong>Accept as tenant</Strong></a>
                                    <form action="{{ route('landlord.houses.tenant.store', ['house_id' => $housedata['house']->id, 'tenant_id' => $housedata['house']->id]) }}" id="tenant_accept_form" method="POST" class="d-none">
                                        @csrf
                                        <input type="text" name="payment_ref" value="{{ 'payment_ref' }}">
                                    </form>
                                </div>
                                <div class="d-grid gap-2 m-1">
                                    @if ($housedata['house']->payments)
                                    <a href="{{ route('landlord.payments.show', ['payment' => $housedata['house']->payments->first()->id]) }}" class="btn btn-info" type="button"><Strong>View payment</Strong></a>
                                    @else
                                    <a href="{{ route('landlord.houses.tenant.request-payment', ['house_id' => $housedata['house']->id, 'tenant_id' => $housedata['house']->id]) }}" class="btn btn-info" type="button"><Strong>Ask for payment</Strong></a>
                                    @endif
                                </div>
                                <div class="d-grid gap-2 m-1">
                                    <a href="#" class="btn btn-dark" onclick="sendhouse_book_form()" type="button"><Strong>Send a message</Strong></a>
                                </div>
                                <div class="d-grid gap-2 mt-1">
                                    <a href="{{ route('welcome') }}" class="btn btn-danger" type="button"><Strong>Cancel
                                            Request</Strong></a>
                                </div>
                                <form action="{{ route('houses.book.store') }}" id="house_book_form" method="POST" class="d-none">
                                    @csrf
                                    <input type="text" name="house" value="{{ $housedata['house']->id }}">
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--end unpaid  bookings section-->
                @endif
            </div>
            <!-- house section -->
            <div class="col-md col-xl col-lg">
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
                                                    <li class="btn btn-secondary m-1 active" data-filter=".{{ $housedata['house']->house_id . $housedata['house']->id }}">
                                                        All</li>
                                                    <li class="btn btn-secondary m-1 " data-filter=".{{ $housedata['house']->house_id . $housedata['house']->id . 'insideimages' }}">
                                                        Inside </li>
                                                    <li class="btn btn-secondary m-1" data-filter=".{{ $housedata['house']->house_id . $housedata['house']->id . 'outsideimages' }}">
                                                        Outside</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row portfolio-container">

                                            @if ($housedata['house']->pictures)
                                            @foreach ((array) json_decode($housedata['house']->pictures) as $key => $images)
                                            @foreach ($images as $image)
                                            <div class="col-md-6 mb-4 portfolio-item {{ $housedata['house']->house_id . $housedata['house']->id }} {{ $housedata['house']->house_id . $housedata['house']->id . $key }}">
                                                <div class="position-relative overflow-hidden mb-2">
                                                    <img class="img-fluid w-100" src="{{ $image }}" alt="">
                                                    <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                                        <a href="{{ $image }}" data-lightbox="portfolio{{ $housedata['house']->id }}">
                                                            <i class="bi bi-plus text-light"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Images End -->
                        </div>
                    </div>
                </div>

            </div>
            <!--end house section -->
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
