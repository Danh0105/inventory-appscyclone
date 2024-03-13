@extends("Admin.Auth.Layout.app")
@section("content")
	<div class="row">
		<div class="col-sm-12">

			<div class="wrapper-page">

				<div class="m-t-40 account-pages">
					<div class="account-logo-box text-center">
						<h2 class="text-uppercase">
							<a class="text-success" href="index.html">
								<span>GET STARTED FREE</span>
							</a>
						</h2>
						<!--<h4 class="text-uppercase m-b-0 font-bold">Sign In</h4>-->
					</div>
					<div class="account-content">
						<form class="form-horizontal" action="{{ route("api.register") }}" method="POST">
							@csrf
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" name="email" type="email" placeholder="Email">
								</div>
							</div>
							@error("email")
								<div class="text-danger m-3">{{ $message }}</div>
							@enderror
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" name="name" type="text" placeholder="Username">
								</div>
							</div>
							@error("name")
								<div class="text-danger m-3">{{ $message }}</div>
							@enderror
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" name="password" type="password" placeholder="Password">
								</div>
							</div>
							@error("password")
								<div class="text-danger m-3">{{ $message }}</div>
							@enderror
							<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" name="company" type="text" placeholder="company">
								</div>
							</div>
							@error("company")
								<div class="text-danger m-3">{{ $message }}</div>
							@enderror
							<div class="form-group">
								<div class="col-xs-12">
									<div class="checkbox checkbox-success">
										<input id="checkbox-signup" type="checkbox" checked="checked">
										<label for="checkbox-signup">I accept <a href="#">{{ __("Terms and Conditions") }}</a></label>
									</div>
								</div>
							</div>

							<div class="form-group account-btn m-t-10 text-center">
								<div class="col-xs-12">
									<button class="btn w-md btn-danger btn-bordered waves-effect waves-light"
										type="submit">{{ __("SIGN UP FREE") }}</button>
								</div>
							</div>

						</form>

						<div class="clearfix"></div>

					</div>
				</div>
				<!-- end card-box-->

				<div class="row m-t-50">
					<div class="col-sm-12 text-center">
						<p class="text-muted">{{ __("OR") }}
							<a class="text-primary m-l-5" href="{{ route("login") }}"><b>{{ __("LOGIN TO YOUR ACCOUNT") }}</b></a>
						</p>
					</div>
				</div>

			</div>
			<!-- end wrapper -->

		</div>
	</div>
@endsection
