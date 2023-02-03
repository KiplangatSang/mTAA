<div>
				<div class="text-info">
								<h3><small>Withdraw to:</small></h3>
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
												<button type="submit" class="btn btn-success" id="withdrawsubmitbtn">Submit</button>
								</div>
								<div class="float-right m-2">
												<a href="#" class="btn btn-danger" id="withdrawcancelbtn">Cancel</a>
								</div>
				</div>

				<script type="text/javascript">
								$("#withdrawbtn").click(function() {
												openWithdrawalForm()
												$('html, body').animate({
																scrollTop: ($("#withdrawalform").offset().top),
												}, 1000);
												$("#withdrawalform").animate({

																marginTop: '150px',
																fontSize: '3em',
												});
								});

								function openWithdrawalForm() {
												document.getElementById("withdrawalSection").style.display = "block";
												$('#submitWithdrawbtn').attr('disabled', "disabled");
								}

								$("#withdrawcancelbtn").click(function() {
												withdrawcancel();
												location.reload(true);

								});
				</script>
</div>
