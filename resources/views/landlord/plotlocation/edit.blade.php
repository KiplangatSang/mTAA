@extends('layouts.login')
@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content ">
    <div class="logo ">
        <h1><strong>{{ config("app.name") }}</strong></h1>
    </div>
    <div class="col-md-8 col-xl-7 mx-auto">

        <form class="form-horizontal" id="regForm" action="{{ route('landlord.plotlocation.update',['id'=>$plot_location_data['plot']->id]) }}" method="POST" enctype="application/x-www-form-urlencoded">
            @csrf
            <h3>Lets register your plot.</h3>
            <br>
            <!-- One "tab" for each step in the form: -->
            <div >
                <div class="">
                    <label class="control-label">What is the name of your plot?</label>
                    <div>
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" placeholder="Enter the name of your plot" name="name" value="{{  $plot_location_data['plot']->name }}" autocomplete="name" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <br>

                </div>
                <div class=" ">
                    <h3 class="control-label">Which type of rentals does it have? </h3>
                    <div class="m-1">
                        @foreach (json_decode($plot_location_data['plot']->house_types) as $type)
                        <input type="text" class="m-1" disabled value="{{ $type }}">
                        @endforeach
                    </div>
                    <p id="retailGoodsLabel">Click on input field to select the type of rentals the plot has.</p>
                    <div>
                        <select class="form-control " type="text" name="house_types[]" multiple="true" id="multipleSelectForm" style="width: 80%;">
                            <optgroup class="form-control" label="Select the rental types available">
                                @foreach ($landlorddata['rental_types'] as $key => $value)
                                <option class="form-control" value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('house_types')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> <br>
                </div>
                <div class="">
                    <div>
                        <h3 class="text-display-4">Plot Location</h3>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="control-label col-md-3">Country</label>
                        <div class="col-md-8">
                            <select type="select" id="countryselect" class="form-control form-control-lg  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                <optgroup label="Select country">
                                    <option class="form-control" value="{{ $plot_location_data['plot']->country }}" selected>
                                        {{ $plot_location_data['plot']->country }}
                                    </option>
                                    @foreach ( $data['countries'] as $country)
                                    <option class="form-control" value="{{ $country['name'] }}">{{ $country['name'] }}
                                    </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">County</label>
                        <div class="col-md-8">
                            <select type="select" id="countyselect" class="form-control form-control-lg  @error('county') is-invalid @enderror" name="county" value="{{ old('county') }}" required autocomplete="county" s>
                                <optgroup label="Select county">

                                    <option value=" {{ $plot_location_data['plot']->county }}" selected"> {{ $plot_location_data['plot']->county }} </option>
                                    @foreach ( $data['counties'] as $county)
                                    <option class="form-control" value="{{ $county['name'] }}">{{ $county['name'] }}
                                    </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('county')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Constituency</label>
                        <div class="col-md-8">
                            <input class="form-control @error('constituency') is-invalid @enderror" type="text" placeholder="Enter the constituency your shop is located" name="constituency" value=" {{ $plot_location_data['plot']->constituency }} " autocomplete="constituency" required>

                            @error('constituency')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Town</label>
                        <div class="col-md-8">
                            <input class="form-control @error('town') is-invalid @enderror " type="text" placeholder="Enter the town your shop is located" name="town" value=" {{ $plot_location_data['plot']->town }}" autocomplete="town" required>

                            @error('town')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <hr>

                </div>
                <div class="">
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="control-label col-md-3">How many houses/ Offices / appartments?</label>
                            <div class="col-md-8">
                                <input class="form-control @error('no_of_houses') is-invalid @enderror" type="text" placeholder="Enter the number of rental units available" name="no_of_houses" id="inputEmp" value="{{ $plot_location_data['plot']->no_of_houses }} " autocomplete="{{ old('no_of_houses') }}">

                                @error('no_of_houses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="submit" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
            </div>
        </form>
    </div>

</section>
<script type="text/javascript">
    $('#sl').on('click', function() {
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({
            text: "Signing In"
        });
    });

    $('#el').on('click', function() {
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({
            html: "Sign In"
        });
    });


    $('#multipleSelectForm').select2();

</script>


@endsection
