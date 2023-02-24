@extends('layouts.app')
@section('content')
				<div class="app-title">
								<div>
												<h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Registered payments</h1>
												<p>List of registered payments</p>
								</div>
								<ul class="app-breadcrumb breadcrumb side">
												<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
												<li class="breadcrumb-item">payments</li>
												<li class="breadcrumb-item active"><a href="#">payments List</a></li>
								</ul>
				</div>
				<div class="row">
								<div class="col">
												<div class="tile">
																<div class="tile-title">Pay Subsription</div>
																<div class="body">
																				<div class="col">
																								<h2>Pay your subsctription now</h2>
																				</div>
																</div>
																<div class="tile-footer">
																				<a href="" class="btn btn-outline-success pill">Pay</a>
																</div>
												</div>
								</div>
								<div class="col">
												<div class="tile">
																<div class="tile-title">Pay Tenant</div>
																<div class="body">
																				<div class="col">
																								<h2>Pay a tenant</h2>
																				</div>
																</div>
																<div class="tile-footer">
																				<a href="" class="btn btn-outline-success pill">Pay</a>
																</div>
												</div>
								</div>
				</div>
				<div class="row">
								<div class="dflex justify-content-center">
												<h2>My history</h2>
								</div>
								<div class="col-md-12">
												<div class="tile">
																<div class="tile-body">
																				<div class="table-responsive">
																								<table class="table table-hover table-bordered" id="sampleTable">
																												<thead>

																																<tr>
																																				<th>Ref</th>
																																				<th>Gateway</th>
																																				<th>Amount</th>
																																				<th>Account</th>
																																				<th>Sender</th>
																																				<th>Status</th>
																																				<th>Reference</th>
																																				<th>Date Reg</th>
																																				<th>View</th>name
																																</tr>
																												</thead>
																												<tbody>
																																@foreach ($paymentdata['payment'] as $payment)
																																				<tr>
																																								<td>{{ $payment->reference }}</td>
																																								<td>{{ $payment->gateway }}</td>
																																								<td>{{ $payment->amount }}</td>
																																								<td>{{ $payment->receiverAccount }}</td>
																																								<td>{{ $payment->sender }}</td>
																																								<td>{{ $payment->status }}</td>
																																								<td>{{ $payment->payment_reference }}</td>
																																								<td>{{ $payment['created_at'] }}</td>
																																								<td><a href="{{ route('landlord.payments.show', ['payment' => $payment->id]) }}"><i
																																																				class="fa fa-eye col">
																																																				View</i></a></td>
																																				</tr>
																																@endforeach
																												</tbody>
																								</table>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection
