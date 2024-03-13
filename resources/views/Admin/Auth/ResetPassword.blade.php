@extends("Admin.Auth.Layout.app")
@section("content")
	<div class="col-sm-12">
		<div class="wrapper-page">
			<div class="m-t-40 account-pages">
				<div class="account-logo-box text-center">
					<h2 class="text-uppercase">
						<P class="text-success" href="index.html">
							FORGOT YOUR PASSWORD ?
						</P>
					</h2>
				</div>
				<div class="account-content">
					<form class="form-horizontal" id="idForm" action="{{ route("api.reset") }}" method="post">
						@csrf
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" name="email" type="email" placeholder="Email">
							</div>
						</div>
						@error("email")
							<div class="text-danger m-3">{{ $message }}</div>
						@enderror
						<div class="recaptcha-wrapper">
							<div class="g-recaptcha" id="myrecaptcha" id="feedback-recaptcha"
								data-sitekey="{{ env("GOOGLE_RECAPTCHA_KEY") }}">
							</div>
							<div class="rc-anchor-checkbox-label">I'm not a Robot.</div>
							<div class="recaptcha-info"></div>
							<div class="rc-anchor-logo-text">reCAPTCHA</div>
							<div class="rc-anchor-pt">
								<a href="https://www.google.com/intl/en/policies/privacy/" target="_blank">Privacy</a>
								<span role="presentation" aria-hidden="true"> - </span>
								<a href="https://www.google.com/intl/en/policies/terms/" target="_blank">Terms</a>
							</div>
						</div>
						@error("g-recaptcha-response")
							<div class="text-danger m-3">{{ $message }}</div>
						@enderror
						<div class="form-group account-btn m-t-10 text-center">
							<div class="col-xs-12">
								<button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
									type="submit">{{ __("RESET") }}</button>
							</div>
						</div>

					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="row m-t-50">
			<div class="col-sm-12 text-center">
				<p class="text-muted">OR <a class="text-primary m-l-5" href="{{ route("register") }}"><b>
							{{ __("CREATE ACCOUNT") }}</b></a></p>
			</div>
		</div>
		<div class="g-recaptcha-outer">
			<div class="g-recaptcha-inner">

			</div>
		</div>
	</div>

	</div>
@endsection
@once
	@push("scripts")
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	@endpush
@endonce
