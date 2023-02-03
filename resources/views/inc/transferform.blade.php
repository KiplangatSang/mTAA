<div>
    <div class="text-info">
        <h3><small>Pay with:</small></h3>
    </div>
    <div class="form-outline mb-2">
        <select type="select" id="name" class="form-control form-control @error('gateway') is-invalid @enderror" name="gateway" value="{{ old('role') }}" required autocomplete="gateway" autofocus>
            <optgroup label="Select payment method">
                @foreach ($data['paymentgateways'] as $key=>$gateway)
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
    <h3><small>Enter amount to send</small></h3>
    <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter amount" required>
    <div class="row p-2 d-flex justify-content-center">
        <div class="float-right m-2">
            <button type="submit" class="btn btn-success" id="submitbtn">Submit</button>
        </div>
        <div class="float-right m-2">
            <a href="#" class="btn btn-danger" id="cancelbtn">Cancel</a>
        </div>
    </div>

    <script type="text/javascript">
        $("#paybtn").click(function(e) {
            var amount = $("#amount_to_pay").val();

            $("#amount").val(amount);

            // alert(amount);

            e.preventDefault();
            $('html, body').animate({
                scrollTop: ($("#paymentSection").offset().top)
            }, 2000);
            openForm()

        });

        function openForm() {
            document.getElementById("paymentSection").style.display = "block";
            $('#paybtn').attr('disabled', "disabled");
        }

        $("#cancelbtn").click(function() {
            cancel();
            location.reload(true);

        });

    </script>
</div>
