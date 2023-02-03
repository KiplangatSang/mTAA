<div>
				<div class="text-info">
								<h3><small>Deposit from:</small></h3>
				</div>
				<div class="form-outline mb-2">
								<select type="select" id="name" class="form-control form-control @error('gateway') is-invalid @enderror"
												name="gateway" value="{{ old('role') }}" required autocomplete="gateway" autofocus>
												<option value="MPESA">Mpesa</option>
								</select>
								@error('gateway')
												<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
												</span>
								@enderror
				</div>

				<div class="col"></div>
				<h3><small>Enter amount</small></h3>
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
								$("#depositbtn").click(function(e) {
												// e.preventDefault();
												openForm()

												$('html, body').animate({
																scrollTop: ($("#paymentform").offset().top),
												}, 1000);
												$("#paymentform").animate({

																marginTop: '150px',
																fontSize: '3em',
												});

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
