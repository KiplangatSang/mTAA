@extends('layouts.login')
@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content ">
    @include('inc.messages')
    <div class="logo ">
        <h1><strong>Welcome to {{ env("APP_NAME") }}</strong></h1>
    </div>
    <!--register box -->
    <div class="register-box p-3 m-2">
        <!--tenant register form-->
        <form class="register-form" method="POST" action="{{ route('register') }}" enctype="application/x-www-form-urlencoded" id="registration-form">
            @csrf
            <div class="row">
                <div class="col">
                    <h4 class="text-uppercase mb-5 login-head"><i class="fa fa-lg fa-fw fa fa-user-circle-o"></i>Create users account</h4>
                </div>
                <div class="col">
                    <div class="float-right m-2">
                        <!--<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>-->
                        <!-- {{ route('register','role=2') }}-->
                        <a href="" data-toggle="register-flip">Or click here to register as landlord</a>
                    </div>
                </div>
            </div>
            <div class="form-outline mb-2 ">
                <div class="row">
                    <div class="col-md-6 col-xl ">
                        <label class="form-label" for="firstname">Your first name</label>
                        <input type="text" id="firstname" class="form-control form-control-lg  @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus />
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-xl">
                        <label class="form-label" for="lastname">Your Surname</label>

                        <input type="text" id="lastname" class="form-control form-control-lg  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" />
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="form-outline mb-2 d-none">
                <label class="form-label" for="role">Your role</label>
                <input type="role" id="role" class="form-control form-control-lg  @error('role') is-invalid @enderror" name="role" value="1" required autocomplete="role" />
                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-outline mb-2">
                <label class="form-label" for="email">Your Email</label>
                <input type="email" id="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
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
                            <label class="form-label" for="country">Country</label>
                            <select type="select" id="countryselect" class="form-control form-control-lg  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                <option value="{{ $region['countryName'] ?? '' }}">{{ $region['countryName']  ?? "" }}
                                </option>
                                @foreach ($region['countries'] as $country)
                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-xl-4">
                        <label class="form-label" for="city">City</label>
                        <input type="city" id="city" class="form-control form-control-lg " name="city" value="{{ $region['cityName'] ?? 'unknown' }}" required autocomplete="city" />
                    </div>
                </div>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label" for="code ">Code</label>
                <input type="code" id="code" class="form-control form-control-lg  " name="code" value="{{ $region['countryCode'] ?? 'unknown' }}" required autocomplete="{{ old('code') }}" disabled />
            </div>
            <div class="form-outline mb-2">
                <div class="row">
                    <div class="col-xl-2 col-md-6 col-sm-4">
                        <label class="form-label" for="phoneCode ">Phone Code</label>
                        <input type="code" class="form-control form-control-lg  " name="phone_code" value="+{{ $region['phoneCode'] ?? '254' }}" required autocomplete="phoneCode" id="phonecode" disabled />
                    </div>
                    <div class="col-xl col-md-6 col-sm">
                        <label class="form-label" for="phoneno">Your Phone Number</label>
                        <input id="phoneno" type="number" class="form-control form-control-lg  @error('phoneno') is-invalid @enderror" name="phoneno" value="{{ old('phoneno') }}" required autocomplete="phoneno" maxlength="10" />
                        @error('phoneno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-outline mb-2">
                <label class="form-label" for="password">Password</label>

                <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8" />

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-outline mb-2">
                <label class="form-label" for="password-confirm" minlength="8">Repeat your password</label>

                <input type="password" id="password-confirm" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" />


            </div>

            <div class="form-check">


                @if (session()->has('terms_and_conditions'))
                <input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror" type="checkbox" value="Accepted" id="terms_and_conditions" name="terms_and_conditions" checked />
                @else
                <input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror" type="checkbox" value="Accepted" id="terms_and_conditions" name="terms_and_conditions" />
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
                <button type="submit" class="btn btn-outline-dark btn-block btn-lg gradient-custom-4 ">{{ __('Register') }}</button>
            </div>

            <p class="text-center text-muted mt-2">Have already an account? <a href="{{ route('login') }}" class="fw-bold text-body"><u>Login here</u></a></p>

        </form>
        <!--landlord register form-->
        <form class="landlord-form bg-secondary" method="POST" action="{{ route('register') }}" enctype="application/x-www-form-urlencoded" id="registration-form">
            @csrf
            <div class="row">
                <div class="col">
                    <h4 class="text-uppercase mb-5 login-head"><i class="fa fa-lg fa-fw fa fa-user-circle-o"></i>Create Landlord account</h4>
                </div>
                <div class="col">
                    <div class="float-right m-2">
                        <!--<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>-->
                        <!-- {{ route('register','role=2') }}-->
                        <a class="btn btn-primary" data-toggle="register-flip">Or Register as Tenant</a>
                    </div>
                </div>
            </div>
            <div class="form-outline mb-2 ">
                <div class="row">
                    <div class=" col-md-6 col-xl">
                        <label class="form-label" for="firstname">Your first name</label>
                        <input type="text" id="firstname" class="form-control form-control-lg  @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus />
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class=" col-md-6 col-xl">
                        <label class="form-label" for="lastname">Your Surname</label>

                        <input type="text" id="lastname" class="form-control form-control-lg  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" />
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="form-outline mb-2 d-none">
                <label class="form-label" for="role">Your role</label>
                <input type="role" id="role" class="form-control form-control-lg  @error('role') is-invalid @enderror" name="role" value="2" required autocomplete="role" />
                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-outline mb-2">
                <label class="form-label" for="email">Your Email</label>
                <input type="email" id="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
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
                            <label class="form-label" for="country">Country</label>
                            <select type="select" id="countryselect" class="form-control form-control-lg  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                <option value="{{ $region['countryName'] ?? '' }}">{{ $region['countryName']  ?? "" }}
                                </option>
                                @foreach ($region['countries'] as $country)
                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-xl-4">
                        <label class="form-label" for="city">City</label>
                        <input type="city" id="city" class="form-control form-control-lg " name="city" value="{{ $region['cityName'] ?? 'unknown' }}" required autocomplete="city" />
                    </div>
                </div>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label" for="code ">Code</label>
                <input type="code" id="code" class="form-control form-control-lg  " name="code" value="{{ $region['countryCode'] ?? 'unknown' }}" required autocomplete="{{ old('code') }}" disabled />
            </div>
            <div class="form-outline mb-2">
                <div class="row">
                    <div class="col-xl-2 col-md-6 col-sm-4">
                        <label class="form-label" for="phoneCode ">Phone Code</label>
                        <input type="code" class="form-control form-control-lg  " name="phone_code" value="+{{ $region['phoneCode'] ?? '254' }}" required autocomplete="phoneCode" id="phonecode" disabled />
                    </div>
                    <div class="col-xl col-md-6 col-sm">
                        <label class="form-label" for="phoneno">Your Phone Number</label>
                        <input id="phoneno" type="number" class="form-control form-control-lg  @error('phoneno') is-invalid @enderror" name="phoneno" value="{{ old('phoneno') }}" required autocomplete="phoneno" maxlength="10" />
                        @error('phoneno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-outline mb-2">
                <label class="form-label" for="password">Password</label>

                <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8" />

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-outline mb-2">
                <label class="form-label" for="password-confirm" minlength="8">Repeat your password</label>

                <input type="password" id="password-confirm" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" />


            </div>

            <div class="form-check">


                @if (session()->has('terms_and_conditions'))
                <input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror" type="checkbox" value="Accepted" id="terms_and_conditions" name="terms_and_conditions" checked />
                @else
                <input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror" type="checkbox" value="Accepted" id="terms_and_conditions" name="terms_and_conditions" />
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
                <button type="submit" class="btn btn-outline-info btn-block btn-lg gradient-custom-4 ">{{ __('Register') }}</button>
            </div>
            <p class="text-center  mt-2">Have already an account? <a href="{{ route('login') }}" class="fw-bold text-body"><u>Login here</u></a></p>

        </form>
    </div>
    </div>
    <script>
        function submitRegistrationForm() {
            document.getElementById("registration-form").submit();

        }

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
