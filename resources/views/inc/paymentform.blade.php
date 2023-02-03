<div>
    <div class="text-info">
        <h3><small>Pay with:</small></h3>
    </div>
    <div class="form-outline mb-2">
        <select type="select" id="name" class="form-control form-control @error('gateway') is-invalid @enderror" name="gateway" value="{{ old('role') }}" required autocomplete="gateway" autofocus>
            <optgroup label="Select payment method">
                @foreach ($data['payment_gateways'] as $key=>$gateway)
                <option value="{{$key}}">{{$gateway}} </option>
                @endforeach
            </optgroup>
        </select>
        @error('gateway')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col"></div>
    <h3 class="text-light"><small>Enter amount to pay</small></h3>
    <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter amount" required>
    <div class="row">

        <div class="col ml-auto m-2">
            <a href="#" class="btn btn-danger" id="cancelbtn">Cancel </a>
        </div>
        <div class="col  mr-auto m-2">
            <button type="submit" class="btn btn-success" id="submitbtn">Submit</button>
        </div>
    </div>

    <script type="text/javascript">
        $("#paybtn").click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: ($("#paymentSection").offset().top)
            , }, 2000);

           // $('#paymentSection').css('-webkit-box-shadow', '10px 10px 5px #888');
           // $('#paymentSection').css('-moz-box-shadow', '10px 10px 5px #888');
           // $('#paymentSection').css('box-shadow', '10px 10px 5px #888');
            $('#paymentSection').css('box-shadow', 'inset 50px 50px 490px black');


            openForm()

        });

        function openForm() {
            document.getElementById("paymentSection").style.display = "block";
            if ($('#paymentSection').css('display') == 'block') {
                $(".content > *").not(".content > #paymentSection").css('opacity', '0.1');
            }
            $('#paybtn').attr('disabled', "disabled");
        }

        $("#cancelbtn").click(function() {
            document.getElementById("paymentSection").style.display = "none";
                      location.reload(true);
        });

    </script>
</div>
