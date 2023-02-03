<div>
				<script>
								$("#submitbtn").click(function() {
												load();
												$('html, body').animate({
																scrollTop: ($("#load").offset().top),
												}, 1000);
												$("#load").animate({

																marginTop: '150px',
																fontSize: '3em',
												});

								});
								$("#withdrawsubmitbtn").click(function() {
												withdrawload();

								});

								function load() {
												if ($('#amount').val().length > 0) {
																document.getElementById("paymentSection").style.display = "none";
																document.getElementById("load").style.display = "block";

												}
								}

								function withdrawload() {
												if ($('#amount').val().length > 0) {
																document.getElementById("withdrawalSection").style.display = "none";
																document.getElementById("load").style.display = "block";

												}
								}

								function cancel() {
												document.getElementById("paymentSection").style.display = "none";
												document.getElementById("load").style.display = "block";
								}

								function withdrawcancel() {
												document.getElementById("withdrawalSection").style.display = "none";
												document.getElementById("load").style.display = "block";
								}
				</script>
				<div class="tile bg-success" id="loadingSection">
								<div class="overlay">
												<div class="m-loader mr-4 ">
																<svg class="m-circular" viewBox="25 25 50 50">
																				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="8"
																								stroke-miterlimit="10" />
																</svg>
												</div>
												<h3 class="l-text">Loading Please Wait</h3>
								</div>
								<div>
												@include('inc.paymentform')
								</div>
				</div>
				<script src="js/plugins/pace.min.js"></script>
</div>
