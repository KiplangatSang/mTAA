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
        <div class="col col-md col-xl mt-5">
            <h3>Click on a row to copy it to the form.</h3>
            <br>
            <div class="row">
                <div class="col">
                    <div class="tile row">
                        @if (count($housedata['houses']) > 0)
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
                        @endif
                    </div>
                </div>
            </div>
            <!--scripts-->
        </div>
        <!--form section -->
        <div class="col col-md col-xl">
            <form class="form-horizontal" id="regForm" action="{{ route('landlord.houses.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf

                <!-- One "tab" for each step in the form: -->
                <!--  "tab" One -->
                <div class="item">
                    <div class="">
                        <label class="control-label">What is the price of the rental unit?</label>
                        <div>
                            <input class="form-control  @error('price') is-invalid @enderror" type="text" placeholder="Enter the price of your rental unit" name="price" value="{{ old('price') }}" autocomplete="price" id="price" required>
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
                            <input class="form-control  @error('floor') is-invalid @enderror" type="text" placeholder="Enter the floor of your rental unit" name="floor" value="{{ old('floor') }}" autocomplete="floor" id="floor" required>
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
                    <div class="">
                        <div class="col-md-8 col-xl-7 form-horizontal mx-auto" id="regForm">
                            <h1>Pictures of the house</h1>
                            <div class="col-md col-xl">
                                <div class="mx-3 d-none">
                                    <div class="tile-title-w-btn">
                                        <h4 class="title">Upload outside area pictures</h4>
                                    </div>
                                    <div class="tile-body">
                                        <p></p>
                                        <h4>Click or drop</h4>
                                        <form class="text-center dropzone" method="POST" enctype="multipart/form-data" action="/client/userprofile/profile/relevant-documents/all" name="Other Documents">
                                            @csrf

                                        </form>
                                    </div>
                                </div>
                                <div class="mx-3">
                                    <div class="tile-title-w-btn">
                                        <h4 class="title">Inside area pictures of the house</h4>
                                    </div>
                                    <div class="tile-body">
                                        <p></p>
                                        <h4>Click or drop</h4>
                                        <form class="text-center dropzone" method="POST" enctype="multipart/form-data" action="{{ route('houses.images.upload.inside') }}" name="Other Documents">
                                            @csrf
                                            <div class="dz-message">Drop files here or click to
                                                upload<br><small class="text-info">Just drop the picture here.</small>
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
                                        <form class="text-center dropzone" method="POST" enctype="multipart/form-data" action="{{ route('houses.images.upload.inside') }}" name="Other Documents">
                                            @csrf
                                            <div class="dz-message">Drop files here or click to
                                                upload<br><small class="text-info">Just drop the picture here.</small>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
<script>
    function getBluetooth() {
        navigator.bluetooth.requestDevice({
                acceptAllDevices: true
                , optionalServices: ['battery_service'] // Required to access service later.
            })
            .then(device => {
                /* … */
            })
            .catch(error => {
                console.error(error);
            });
    }

    function getBluetooth1() {
        navigator.bluetooth.requestDevice({
                filters: [{
                    services: ['health_thermometer']
                }]
            })
            .then(device => device.gatt.connect())
            .then(server => server.getPrimaryService('health_thermometer'))
            .then(service => service.getCharacteristic('measurement_interval'))
            .then(characteristic => characteristic.getDescriptor('gatt.characteristic_user_description'))
            .then(descriptor => descriptor.readValue())
            .then(value => {
                const decoder = new TextDecoder('utf-8');
                console.log(`User Description: ${decoder.decode(value)}`);
            })
            .catch(error => {
                console.error(error);
            });
    }

</script>
@endsection
