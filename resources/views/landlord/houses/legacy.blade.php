@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i>Stock</h1>
        <p>Stock Registration</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Stock</li>
        <li class="breadcrumb-item"><a href="#">Save Stock Item</a></li>
    </ul>
</div>
<div class="row">
    <div class="col">
        <div class="tile row">
            @if (count($housedata['house']) > 0)
            <div class="col-md col-xl">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Item </th>
                                    <th>Item Name</th>
                                    <th>Size/Type</th>
                                    <th>Amount</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($housedata['house'] as $house)
                                <tr>
                                    <td>
                                        <img class="icon d-flex w-100" src="{{ $house->image }}" alt="{{ $house->name }}">
                                    </td>
                                    <td>
                                        {{ $house->type }}
                                    </td>
                                    <td>
                                        {{ $house->size }}
                                    </td>
                                    <td>
                                        {{ count($house->stocks()->get()) }}
                                    </td>


                                    <td>
                                        {{ $house->price }}
                                    </td>
                                    <td>
                                        {{ $house->price }}
                                    </td>

                                    <td>
                                        <div class="animated-checkbox">
                                            <label>
                                                <button class="btn btn-info" id="btncopy{{ $house->name }}" onclick='duplicateItem(@json($house->name),@json($house->image),@json($house->brand),@json($house->size),@json($house->buying_price),@json($house->selling_price))'>Copy
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
            <div class="col-md col-xl">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/client/stock/store">
                    @csrf
                    <h3 class="tile-title">Stock Item</h3>
                    <div class="tile-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Item Name</label>
                            <div class="col-md-8">
                                <input class="form-control  @error('name') is-invalid @enderror" id="stockName" name="name" type="text" placeholder="Enter Stock name" value="{{ old('name') }}" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Click to select item image</label>
                            <div class="col-md-8">
                                <input class="form-control  @error('stockImageFile') is-invalid @enderror" id="stockImageFile" name="stockImageFile" type="file" placeholder="Enter item image">

                                @error('stockImageFile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                        @if (count($stockdata['allStock']) > 0)
                        <div class="form-group row ">
                            <label class="control-label col-md-3" id="selecttoreuselabel"></label>
                            <div>
                                <div class="col-md-6" id="selectedimage">
                                    {{-- <img src="{{ old('stockImageUrl') }}" alt="stock image" id="stockImageSrc"
                                    class="w-50"> --}}
                                </div>
                                <div id="selectedcheckbox">
                                    <input class="form-control  @error('stockImage') is-invalid @enderror" id="stockImageid" name="stockImageUrl" type="checkbox" value="{{ old('stockImageUrl') }}" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label class="control-label col-md-3">Item Brand</label>
                            <div class="col-md-8">
                                <input class="form-control  @error('brand') is-invalid @enderror" id="brand" name="brand" type="text" placeholder="Enter the brand" value="{{ old('brand') }}" required>

                                @error('brand')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Description/Size</label>
                            <div class="col-md-8">
                                <input class="form-control   @error('size') is-invalid @enderror" id="stockSize" name="size" type="text" placeholder="Description ie kgs or litres" value="{{ old('size') }}" required>

                                @error('size')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Enter the Buying Price</label>
                            <div class="col-md-8">
                                <input class="form-control col-md-8  @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" type="number" placeholder="Enter the buying price per item" value="{{ old('buying_price') }}" required>

                                @error('buying_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Enter the Selling Price</label>
                            <div class="col-md-8">
                                <input class="form-control col-md-8  @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" type="number" placeholder="Enter the selling price per item" value="{{ old('selling_price') }}" required>

                                @error('selling_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>



                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Store Stock</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>




        </div>
    </div>
</div>

<script>
    function checkBox() {
        var stockImageid = document.getElementById("stockImageid");
        if (stockImageid.value != "" && stockImageid.value != null) {
            stockImageid.disabled = false;
            stockImageid.checked = true;
        }
    }

    function duplicateItem(stockName, stockImage, brand, stockSize, buying_price, selling_price) {
        $('#selectedimage').append($('<img>', {
            id: 'stockImageSrc'
            , src: @json(old('stockImageUrl'))
            , alt: 'stock image'
            , class: 'd-flex w-100'
        }))

        // $("#selectedcheckbox").append('<input type="checkbox" id="' + sensorId + 'VisibleCheckbox" name="' + sensorId +
        // 				'VisibleCheckbox" >');

        var stockNameid = document.getElementById("stockName");
        var brandid = document.getElementById("brand");
        var stockSizeid = document.getElementById("stockSize");
        //var stockAmountid = document.getElementById("stockAmount");
        var buying_priceid = document.getElementById("buying_price");
        var selling_priceid = document.getElementById("selling_price");
        var stockImageid = document.getElementById("stockImageid");
        var stockImageSrcid = document.getElementById("stockImageSrc");
        //var stockImageUrlid= document.getElementById("stockImageUrl");

        stockNameid.value = stockName;
        brandid.value = brand;
        stockSizeid.value = stockSize;
        // stockAmountid.value = stockAmount;
        buying_priceid.value = buying_price;
        selling_priceid.value = selling_price;
        //stockImageUrlid.value =stockImage;
        stockImageid.value = stockImage;
        stockImageid.checked = true;
        if (stockImageid.value != "" || stockImageid.value != null) {
            stockImageid.disabled = false;
            stockImageid.checked = true;
        }
        stockImageid.disabled = false;
        stockImageSrc.src = stockImage;

        var button = document.getElementsByTagName('button');
        button.innerHTML = "Copy This";
        var btncopy = document.getElementById("btncopy" + stockName);
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
