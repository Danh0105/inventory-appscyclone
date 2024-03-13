@extends("Admin.Auth.Layout.app")
@section("content")
	<div class="row">
		<div class="col-sm-12">

			<div class="wrapper-page">

				<div class="m-t-40 account-pages">
					<div class="account-logo-box text-center">
						<h2 class="text-uppercase">
							<a class="text-success" href="index.html">
								<span><img src="assets/images/logo.png" alt="" height="36"></span>
							</a>
						</h2>
						<!--<h4 class="text-uppercase m-b-0 font-bold">Sign In</h4>-->
					</div>
					<div class="account-content">
						<form class="form-horizontal" id="idForm" action="{{ route("api.resetpass") }}" method="POST">
							@csrf
							<input name="email" type="hidden" value="{{ $email }}">
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" id="password" name="password" type="password" required=""
										placeholder="Password">
								</div>
							</div>
							<div class="text-danger m-3" id="password-match"></div>
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" id="password-confirm" name="password-confirm" type="password" required=""
										placeholder="Password Confirm">
								</div>

							</div>
							<div class="text-danger m-3" id="password-confirm"></div>
							<div class="form-group account-btn m-t-10 text-center">
								<div class="col-xs-12">
									<button class="btn w-md btn-danger btn-bordered waves-effect waves-light"
										type="submit">{{ __("Change for password") }}</button>
								</div>
							</div>

						</form>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="row m-t-50">
					<div class="col-sm-12 text-center">
						<p class="text-muted">{{ __("Already have account?") }}
							<a class="text-primary m-l-5" href="{{ route("login") }}"><b>{{ __("Sign In") }}</b></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@once
	@push("scripts")
		<script>
			$("#idForm").on("submit", function(e) {
				e.preventDefault();
				var password = document.getElementById("password").value;
				var passwordConfirm = document.getElementById("password-confirm").value;
				var passwordMatchMessage = document.getElementById("password-match");
				var form = $(this);
				var actionUrl = form.attr('action');
				var formData = form.serialize();

				if (password !== passwordConfirm) {
					passwordMatchMessage.textContent = "Mật khẩu không khớp.";
				} else if (password.length < 8) {
					passwordMatchMessage.textContent = "Mật khẩu phải có ít nhất 8 ký tự.";
				} else {
					$.ajax({
						type: "POST",
						url: actionUrl,
						data: formData,
						success: function(data) {
							window.location.href = "{{ route("login") }}";
						},
						error: function(error) {
							console.error("Error occurred:", error);
						}
					});
				}
			});
		</script>
	@endpush
@endonce
