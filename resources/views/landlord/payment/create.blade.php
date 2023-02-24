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
								<div class="col-md-12">
												<div class="tile">
																<div class="tile-body">


																</div>
												</div>
								</div>
				</div>
@endsection
