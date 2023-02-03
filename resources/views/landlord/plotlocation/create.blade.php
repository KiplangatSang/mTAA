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

        <form class="form-horizontal" id="regForm" action="{{ route('landlord.plotlocation.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
            @csrf
            <h3>Lets register your plot.</h3>
            <br>
            <!-- One "tab" for each step in the form: -->
            <!--  "tab" One -->
            <div class="tab">
                <label class="control-label">What is the name of your plot?</label>
                <div>
                    <input class="form-control  @error('name') is-invalid @enderror" type="text" placeholder="Enter the name of your plot" name="name" value="{{ old('name') }}" autocomplete="name" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <br>

            </div>
            <div class="tab ">

                <h3 class="control-label">Which type of rentals does it have? </h3>
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
            <div class="tab">
                <div>
                    <h3 class="text-display-4">Plot Location</h3>
                </div>
                <div class="form-group row">
                    <label for="country" class="control-label col-md-3">Country</label>
                    <div class="col-md-8">
                        <select type="select" id="countryselect" class="form-control form-control-lg  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                            <optgroup label="Select country">
                                <option class="form-control" value="{{ $data['region']['countryName'] ?? '' }}">
                                    {{ $data['region']['countryName'] ?? '' }}
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
                        <input class="form-control @error('constituency') is-invalid @enderror" type="text" placeholder="Enter the constituency your shop is located" name="constituency" value="{{ old('constituency') }}" autocomplete="constituency" required>

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
                        <input class="form-control @error('town') is-invalid @enderror " type="text" placeholder="Enter the town your shop is located" name="town" value="{{ old('town') }}" autocomplete="town" required>

                        @error('town')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <hr>

            </div>
            <div class="tab">
                <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-md-3" >How many houses/ Offices / appartments?</label>
                        <div class="col-md-8">
                            <input class="form-control @error('no_of_houses') is-invalid @enderror" type="text" placeholder="Enter the number of rental units available" name="no_of_houses" id="inputEmp" value="{{ old('no_of_houses') }}" autocomplete="{{ old('no_of_houses') }}" >

                            @error('no_of_houses')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
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

<script>
    function disableEmpInput() {
        var inputEmp = document.getElementById("inputEmp");
        inputEmp.disabled = true;
    }

    function enableEmpInput() {
        var inputEmp = document.getElementById("inputEmp");
        inputEmp.disabled = false;
    }

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;

        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:

            document.getElementById("regForm").submit();

            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, z, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        z = x[currentTab].getElementsByTagName("select");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (z.length == 1) {

                if (z[0].value == "") {
                    var retailGoodsLabel = document.getElementById("retailGoodsLabel");
                    retailGoodsLabel.innerHTML = " This field is required"
                    retailGoodsLabel.style.color = "red";
                    valid = false;
                }

            } else if (y[i].value == "") {
                //check if disabled
                if (y[i].disabled == true) {
                    valid = true;
                } else {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }

            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

</script>
@endsection
