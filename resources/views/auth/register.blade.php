@extends('layouts.login')
@section('content')
				<section class="material-half-bg">
								<div class="cover"></div>
				</section>
				<section class="login-content ">
								<div class="logo ">
												<h1><strong>DukaVerse</strong></h1>
								</div>
								{{-- {{dd($region)}} --}}
								<div class="register-box">
												<div class="card-body ">
																<h2 class="text-uppercase text-center mb-5 login-head"><i
																								class="fa fa-lg fa-fw fa fa-user-circle-o"></i>Create an account</h2>

																<form method="POST" action="{{ route('register') }}">
																				@csrf

																				<div class="form-outline mb-2">
																								<input type="text" id="name"
																												class="form-control form-control-lg  @error('username') is-invalid @enderror" name="username"
																												value="{{ old('username') }}" required autocomplete="username" autofocus />
																								<label class="form-label" for="username">Your Name</label>
																								@error('username')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																				<div class="form-outline mb-2">
																								<input type="email" id="email"
																												class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email"
																												value="{{ old('email') }}" required autocomplete="email" />
																								<label class="form-label" for="email">Your Email</label>
																								@error('email')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																				<div class="form-outline mb-2 ">
																								<div class="row form-group">
																												<div class="col-md-6  col-xl-4">
																																<div class="form-outline">
																																				<select type="select" id="countryselect"
																																								class="form-control form-control-lg  @error('country') is-invalid @enderror"
																																								name="country" value="{{ old('country') }}" required autocomplete="country"
																																								autofocus>
																																								<option value="{{ $region['countryName'] }}">{{ $region['countryName'] }}
																																								</option>
																																								@foreach ($region['countries'] as $country)
																																												<option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
																																								@endforeach
																																				</select>
																																				<label class="form-label" for="country">Country</label>
																																				@error('country')
																																								<span class="invalid-feedback" role="alert">
																																												<strong>{{ $message }}</strong>
																																								</span>
																																				@enderror
																																</div>
																												</div>
																												<div class="col-md-6  col-xl-4">
																																<input type="city" id="city" class="form-control form-control-lg " name="city"
																																				value="{{ $region['cityName'] ?? 'unknown' }}" required autocomplete="city" />
																																<label class="form-label" for="city">City</label>

																												</div>

																								</div>
																				</div>
																				<div class="form-outline mb-2">
																								<input type="code" id="code" class="form-control form-control-lg  " name="code"
																												value="{{ $region['countryCode'] ?? 'unknown' }}" required autocomplete="{{ old('code') }}"
																												disabled />
																								<label class="form-label" for="code ">Code</label>
																				</div>
																				<div class="form-outline mb-2">
																								<div class="row">
																												<div class="col-xl-2 col-md-2 col-sm-2">
																																<input type="code" class="form-control form-control-lg  " name="phone_code"
																																				value="+{{ $region['phoneCode'] ?? '254' }}" required autocomplete="phoneCode"
																																				id="phonecode" disabled />
																																<label class="form-label" for="phoneCode ">Phone Code</label>
																												</div>
																												<div class="col-xl col-md-4 col-sm-4">
																																<input id="phoneno" type="number"
																																				class="form-control form-control-lg  @error('phoneno') is-invalid @enderror"
																																				name="phoneno" value="{{ old('phoneno') }}" required autocomplete="phoneno"
																																				maxlength="10" />
																																<label class="form-label" for="phoneno">Your Phone Number</label>
																																@error('phoneno')
																																				<span class="invalid-feedback" role="alert">
																																								<strong>{{ $message }}</strong>
																																				</span>
																																@enderror
																												</div>
																								</div>
																				</div>

																				<div class="form-outline mb-2">
																								<input type="password" id="password"
																												class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
																												required autocomplete="new-password" minlength="8" />
																								<label class="form-label" for="password">Password</label>

																								@error('password')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>

																				<div class="form-outline mb-2">
																								<input type="password" id="password-confirm" class="form-control form-control-lg"
																												name="password_confirmation" required autocomplete="new-password" />
																								<label class="form-label" for="password-confirm" minlength="8">Repeat your password</label>

																				</div>

																				<div class="form-check">


																								@if (session()->has('terms_and_conditions'))
																												<input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror"
																																type="checkbox" value="Accepted" id="terms_and_conditions" name="terms_and_conditions"
																																checked />
																								@else
																												<input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror"
																																type="checkbox" value="Accepted" id="terms_and_conditions"
																																name="terms_and_conditions" />
																								@endif


																								<label class="form-check-label mt-1" for="form2Example3g">
																												I agree all statements in <a href="/terms_and_conditions" class="text-body"><u>Terms of
																																				service</u></a>
																								</label>

																								@error('terms_and_conditions')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror

																				</div>

																				<div class="d-flex justify-content-center mt-2">
																								<button type="submit"
																												class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">{{ __('Register') }}</button>
																				</div>

																				<p class="text-center text-muted mt-2">Have already an account? <a href="{{ route('login') }}"
																												class="fw-bold text-body"><u>Login here</u></a></p>

																</form>

												</div>


								</div>
								<script>
												$('#countryselect').on('change', function() {
																searchCode();
												});

												function searchCode() {
																var filter = $('#countryselect').find(":selected").val();
																var countryarray = @json($region['countries']);

																for (var i = 0; i < countryarray.length; i++) {
																				if (countryarray[i]["name"] == filter) {
																								console.log(countryarray[i]);
																								$('#phonecode').val("+" + countryarray[i]['phonecode']);
																								$('#code').val(countryarray[i]['iso3']);


																				}
																}



												}
								</script>
				</section>
@endsection
