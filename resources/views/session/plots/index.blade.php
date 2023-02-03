@extends('layouts.login')
@section('content')
				<section class="material-half-bg">
								<div class="cover"></div>
				</section>
				<section class="login-content ">
								<div class="logo ">
												<h1><strong>{{ config('app.name') }}</strong></h1>
								</div>
								<div class="retail-box bg-white">
												<form class="form-horizontal p-3" method="POST" action="{{ route('session.plotlocation.store') }}">
																@csrf

																<h3 class="login-head"><i class="fa fa-lg fa-fw fa-home"></i>Select Your plot</h3>

																<select class="form-control mt-3 mb-3  @error('plot') is-invalid @enderror" name="plot">
																				<optgroup class="form-control" label="Select your plot to login">
																								@foreach ($sessiondata['plots'] as $plot)
																												<option class="form-control" value="{{ $plot->id }}">{{ $plot->name }}</option>
																								@endforeach
																				</optgroup>
																</select>
																@error('plot')
																				<span class="invalid-feedback" role="alert">
																								<strong>{{ $message }}</strong>
																				</span>
																@enderror
																<div class="row-3  btn-bottom mx-auto p-3">
																				<button class=" btn form-control btn-success mt-3 mb-3" type="submit">Sign In</button>

																</div>


												</form>


								</div>
				</section>
@endsection
