@extends('layouts.app')
@section('content')
				<div class="app-title">
								<div>
												<h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} payments</h1>
												<p>List of entered payments</p>
								</div>
								<ul class="app-breadcrumb breadcrumb side">
												<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
												<li class="breadcrumb-item">Payments</li>
												<li class="breadcrumb-item active"><a href="#">Payments List</a></li>
								</ul>
				</div>
				<div class="row">
								<div class="col-md-12">
												<div class="tile">
																<div class="tile-body">
																				<p>{{ $$paymentdata['payment']->reference }}</p>
																				<p>{{ $$paymentdata['payment']->gateway }}</p>
																				<p>{{ $$paymentdata['payment']->amount }}</p>
																				<p>{{ $$paymentdata['payment']->receiverAccount }}</p>
																				<p>{{ $$paymentdata['payment']->sender }}</p>
																				<p>{{ $$paymentdata['payment']->status }}</p>
																				<p>{{ $$paymentdata['payment']->payment_reference }}</p>
																				<p>{{ $$paymentdata['payment']['created_at'] }}</p>
																				<p><a href="{{ route('landlord.paymentlocation.show', ['id' => $payment->id]) }}"><i
																																class="fa fa-eye col">
																																View</i></a></p>
																</div>
																<div class="row">
																				<button class="btn btn-danger">Reverse Payment</button>
																</div>
												</div>
								</div>
				</div>
@endsection
