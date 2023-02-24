@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!--payment  section -->
    <div class="col-md-6 col-xl-4 mt-5 mx-auto item">
        <div class="mt-5">
            <div class="d-flex justify-content-center">
                <h2 class="tile-title">Payment</h2>
            </div>

            <div class="row m-1">
                <div class="col">
                    <p class="m-2"> Payment Status:
                        @if (($paymentdata['payment']->status))
                        <span class="badge badge-success"><small>Paid</small></span>
                        @else
                        <span class="badge badge-danger"><small>Not yet paid</small></span>
                        @endif </p>

                </div>
            </div>
            <br>
            <div class="row m-1">
                <div class="col">
                    <p class="m-2"> Paid Amount: <strong>ksh {{ $paymentdata['payment']->amount }}</strong>
                    </p>
                </div>
            </div>
            <div class="row m-1">
                <div class="col">
                    <p class="m-2"> Gateway <Strong>{{ $paymentdata['payment']->gateway }}</Strong></p>
                </div>
                <br>
            </div>
            <div class="row m-1">
                <div class="col">
                    <p class="m-2">Account:
                        <strong><span class="badge badge-dark"> {{ $paymentdata['payment']->receiver_account }}
                        </span></strong></p>
                </div>
                <br>
            </div>
            <div class="row m-1">
                <div class="col">
                    <p>Reference: <Strong>{{ $paymentdata['payment']->reference }}</Strong></p>
                </div>
                <br>
            </div>
            <div class="row m-1">
                <div class="col">
                    <p class="m-2">Status: </p>
                    @if ($paymentdata['payment']->status == true)
                    <h2><span class="badge badge-warning">Processed</span></h2>
                    @else
                    <h2><span class="badge badge-warning">Money on Hold</span></h2>
                    @endif
                    <br>
                </div>
            </div>
            <br>
            <div class="row mx-auto d-flex justify-content-center m-2">
                <div class="d-grid gap-2  m-1">
                    <a href="#" class="btn btn-dark" onclick="event.preventDefault(); document.getElementById('payment_reverse_form').submit();" type="button"><Strong>Refund this payment</Strong></a>
                </div>
                <form action="{{ route('landlord.payment.reverse', ['payment_id' => $paymentdata['payment']->id]) }}" id="payment_reverse_form" method="POST" class="d-none">
                    @csrf
                    <input type="text" name="payment_ref" value="{{ 'payment_ref' }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
