@extends('layouts.login')
@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content ">
    <div class="logo ">
        <h1><strong>{{ config("app.name") }}</strong></h1>
    </div>
    <div class="container item row">
        <div class="row">
            <div class="col mx-auto d-flex justify-content-center">
                <h3>Lets register your Houses.</h3>
                <br>
            </div>
        </div>
        <!--copy item table-->
        @if (count($housedata['houses']) > 0)
        @if (!session('house'))
        <div class="col col-md col-xl mt-5">
            <h3>Click on a row to copy it to the form.</h3>
            <br>
            <div class="row">
                <div class="col">
                    <div class="tile row">
                        <div class="col-md col-xl">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sampleTable">
                                        <thead>
                                            <tr>
                                                <th>House </th>
                                                <th>Type</th>
                                                <th>Size/Type</th>
                                                <th>Floor</th>
                                                <th>Price</th>
                                                <th>Copy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($housedata['houses'] as $house)
                                            <tr>
                                                <td>
                                                    <img class="icon d-flex w-100" src="{{ $house->profile->profile_image ?? 'https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/nofile.png'  }}" alt="{{ $house->name }}">
                                                </td>
                                                <td>
                                                    {{ $house->type }}
                                                </td>
                                                <td>
                                                    {{ $house->size }}
                                                </td>
                                                <td>
                                                    {{ $house->floor }}
                                                </td>
                                                <td>
                                                    {{ $house->price }}
                                                </td>

                                                <td>
                                                    <div class="animated-checkbox">
                                                        <label>
                                                            <button class="btn btn-info" id="btncopy{{ $house->id }}" onclick='duplicateItem(@json($house->id),@json($house->price),@json($house->type),@json($house->size),@json($house->floor),@json($house->description ?? ""),@json($house->profile->profile_image ?? "https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/nofile.png"))'>Copy
                                                            </button>
                                                        </label>
                                                    </div>

                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--scripts-->
        </div>
        @endif
        @endif
        <!--form section -->
        <div class="col col-md col-xl">
            <div class="tab">
                <form class="form-horizontal" id="regForm" action="{{ route('landlord.houses.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
                    @csrf

                    <!-- One "tab" for each step in the form: -->
                    <!--  "tab" One -->
                    <div class="item">
                        <div class="">
                            <label class="control-label">What is the price of the rental unit?</label>
                            <div>
                                <input class="form-control  @error('price') is-invalid @enderror" type="number" placeholder="Enter the price of your rental unit" name="price" value="{{ old('price') }}" autocomplete="price" id="price" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                        </div>

                        <!--image selection-->
                        <div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Click to select item image of your rental unit</label>
                                <div class="col-md-8">
                                    <input class="form-control  @error('image') is-invalid @enderror" id="image" name="image" type="file" placeholder="Enter item image">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            </div>
                            @if (count($housedata['houses']) > 0)
                            <div class="form-group row ">
                                <label class="control-label col-md-3" id="selecttoreuselabel"></label>
                                <div>
                                    <div class="col-md-6" id="selectedimage">
                                        <!-- <img src="{{ old('imageUrl') }}" alt="image" id="profileSrc" class="w-50">-->

                                    </div>
                                    <div id="selectedcheckbox">
                                        <input class="@error('image') is-invalid @enderror" id="houseImageid" name="imageUrl" type="checkbox" value="{{ old('imageUrl') }}" disabled>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class=" ">
                            <h3 class="control-label">Which type is it? </h3>
                            <p>Click on input field to select the type of rentals the plot has.</p>
                            <div>
                                <select class="form-control " type="text" name="type" style="width: 100%;" id="type">
                                    <optgroup class="form-control" label="Select the rental types available">
                                        @foreach ($landlorddata['rental_types'] as $key => $value)
                                        <option class="form-control" value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="">
                            <label class="control-label">At what floor is it located i.e. 3rd floor, ground floor?</label>
                            <div>
                                <input class="form-control  @error('floor') is-invalid @enderror" type="number" placeholder="Enter the floor of your rental unit" name="floor" value="{{ old('floor') }}" autocomplete="floor" id="floor" required>
                                @error('floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="">
                            <label class="control-label">What is the size i.e.Small, Large, Extra Large?</label>
                            <div>
                                <select class="form-control " type="text" name="size" style="width: 100%;" id="size">
                                    <optgroup class="form-control" label="Select the rental space size">
                                        <option class="form-control" value="Small">Small</option>
                                        <option class="form-control" value="Medium">Medium</option>
                                        <option class="form-control" value="Large">Large</option>
                                        <option class="form-control" value="Extra Large">Extra Large</option>
                                    </optgroup>
                                </select>
                                @error('house_types')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="">
                            <div>
                                <h3 class="text-display-4">Enter a short house description (Optional)</h3>
                            </div>
                            <div class="p-2 m-2">
                                <textarea name="description" id="description" cols="30" class="form-control" placeholder="Enter a short house description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row mx-auto">
                            <div class="col d-flex justify-content-center"><a type="cancel" class="btn btn-danger">Cancel</a></div>
                            <div class="col"> <button type="submit" class="btn btn-success">Submit</button></div>


                        </div>
                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                    </div>
                </form>
            </div>
            <!--Pictures of the house-->
            <div class="tab">
                <div class="col-md-8 col-xl-7 form-horizontal mx-auto" id="regForm">
                    <h1>Pictures of the house</h1>
                    <div class="col-md col-xl">
                        <div class="mx-3">
                            <div class="tile-title-w-btn">
                                <h4 class="title">Inside area pictures of the house</h4>
                            </div>
                            <div class="tile-body">
                                <p></p>
                                <h4>Click or drop</h4>
                                <form class="text-center dropzone" method="POST" enctype="multipart/form-data" action="{{ route('houses.images.inside.store') }}" name="Other Documents">
                                    @csrf
                                    <input type="text" name="class" value="inside" class="d-none">
                                    <input type="text" name="house" value="" class="d-none" id="inside-house-id">
                                    <div class="dz-message">Drop files here or click to
                                        upload<br><small class="text-info">().</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="mx-3">
                            <div class="tile-title-w-btn">
                                <h4 class="title">Upload outside area pictures of the house</h4>
                            </div>
                            <div class="tile-body">
                                <p></p>
                                <h4>Click or drop</h4>
                                <form class="text-center dropzone" method="POST" enctype="multipart/form-data" action="{{ route('houses.images.outside.store') }}" name="Other Documents">
                                    @csrf
                                    <input type="text" name="class" value="outside" class="d-none">
                                    <input type="text" name="house" value="" class="d-none" id="outside-house-id">
                                    <div class="dz-message">Drop files here or click to
                                        upload<br><small class="text-info">()</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none">
            <form class="form-horizontal" id="closeform" action="{{ route('landlord.houses.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                <input type="text" class="form-control" name="action" value="close">
            </form>
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
        </div>
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

<!--tab actions-->
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

    if (@json(session('house'))) {
        var house = @json(session('house'));
        var id = house.id;
        $('#outside-house-id').val(id);
        $('#inside-house-id').val(id);
        nextPrev(1)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // check if the form had already been submitted:
        if (!@json(session('house'))) {
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
        }

        // Hide the current tab:
        x[currentTab].style.display = "none";

        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:

            document.getElementById("regForm").submit();
            if (document.getElementById("nextBtn").innerHTML == "Submit") {
                document.getElementById("closeform").submit();

            }
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

<!-- copying image scripts-->
<script>
    function checkBox() {
        var houseImageid = document.getElementById("houseImageid");
        if (houseImageid.value != "" && houseImageid.value != null) {
            houseImageid.disabled = false;
            houseImageid.checked = true;
        }
    }

    function duplicateItem(id, price
        , type
        , size
        , floor, description, image) {
        $('#selectedimage').empty();
        $('#selectedimage').append(
            $('<img>', {
                id: 'profileSrc'
                , src: @json(old('imageUrl'))
                , alt: 'image'
                , class: 'd-flex w-100'
            }));

        var priceid = document.getElementById("price");
        var typeid = document.getElementById("type");
        var sizeid = document.getElementById("size");
        var floorid = document.getElementById("floor");
        var descriptionid = document.getElementById("description");

        priceid.value = price;
        typeid.value = type;
        sizeid.value = size;
        floorid.value = floor;
        houseImageid.value = image;
        descriptionid.value = description;
        houseImageid.checked = true;
        if (houseImageid.value != "" || houseImageid.value != null) {
            houseImageid.disabled = false;
            houseImageid.checked = true;
        }
        houseImageid.disabled = false;
        profileSrc.src = image;

        var button = document.getElementsByTagName('button');
        button.innerHTML = "Copy This";
        var btncopy = document.getElementById("btncopy" + id);
        btncopy.innerHTML = "Recopy";
        btncopy.style.backgroundColor = "red";

        $('#selecttoreuselabel').text("Or Select to re-use");

    }
    window.onload = checkBox;

</script>

@endsection
