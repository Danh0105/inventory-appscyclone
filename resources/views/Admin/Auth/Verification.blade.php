@extends("Admin.Auth.Layout.app")
@section("content")
	<div class="form-verification">
		<div class="verification-heading">
			Verification
		</div>
		<div class="verification-body">
			<form id="idForm" action="{{ route("re.verification") }}" method="POST">
				@csrf
				<label class="col-md-2 control-label">Email nhận mã</label>
				<div>
					<input class="input-email" id="" name="email" type="text" value="{{ $email }}">
					<i class="glyphicon glyphicon-pencil"></i>
				</div>
				<div class="text-danger m-3" id="email"></div>
				<label class="col-md-2 control-label">Mời nhập mã</label>
				<input class="input input-verification" id="input1" type="text" pattern="[0-9]{1}" maxlength="1">
				<input class="input input-verification" id="input2" type="text" pattern="[0-9]{1}" maxlength="1">
				<input class="input input-verification" id="input3" type="text" pattern="[0-9]{1}" maxlength="1">
				<input class="input input-verification" id="input4" type="text" pattern="[0-9]{1}" maxlength="1">
				<input class="input input-verification" id="input5" type="text" pattern="[0-9]{1}" maxlength="1">
				<input class="input input-verification" id="input6" type="text" pattern="[0-9]{1}" maxlength="1">
				<div class="recaptcha-wrapper" id="captcha-ob" style="display: none">
					<div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env("GOOGLE_RECAPTCHA_KEY") }}">
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
				<div class="text-danger m-3" id="captcha"></div>
				<div class="verification-alert varification-alert-danger" id="alert" role="alert">
					Mã xác thực không đúng!
				</div>
				<div class="cooldown" id="countdown"></div>
				<button class="btn btn-teal btn-rounded waves-light waves-effect w-md" id="sendButton" type="submit"
					style="display: none;margin:auto;">
					<i class="glyphicon glyphicon-refresh"></i> {{ __("Gửi mã") }}
				</button>
			</form>
			<button class="btn btn-teal btn-rounded waves-light waves-effect w-md ms5" id="showdButton">
				<i class="glyphicon glyphicon-refresh"></i> {{ __("Bạn chưa nhận được mã?") }}
			</button>
		</div>
	</div>
@endsection
@once
	@push("scripts")
		<link type="text/css" href="/assets/css/verification.css" rel="stylesheet" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script>
			var timer;
			var arr = @json($randomNumbers);
			var interval = setInterval(updateCountdown, 1000);
			const inputs = document.querySelectorAll('.input');
			const countdownElement = document.getElementById("countdown");
			var timeLeft = 60;

			function updateCountdown() {
				if (timeLeft <= 0) {
					clearInterval(timer);
					countdownElement.textContent = `Thời gian còn lại: 0 giây`;
					arr = '';
				} else {
					countdownElement.textContent = `Thời gian còn lại: ${timeLeft} giây`;
					timeLeft--;
				}
			}
			inputs.forEach((input, index) => {
				input.addEventListener('input', (event) => {
					const currentValue = event.target.value;
					if (currentValue) {
						if (index < inputs.length - 1) {
							inputs[index + 1].focus();
						} else {
							console.log(timeLeft);
							if (arr !== '' || timeLeft === 0)
								verification(arr);
						}
					}
				});
			});

			function verification(arr) {
				var alert = document.getElementById("alert");
				var value1 = document.getElementById("input1").value;
				var value2 = document.getElementById("input2").value;
				var value3 = document.getElementById("input3").value;
				var value4 = document.getElementById("input4").value;
				var value5 = document.getElementById("input5").value;
				var value6 = document.getElementById("input6").value;
				if (
					value1 == arr[0] &&
					value2 == arr[1] &&
					value3 == arr[2] &&
					value4 == arr[3] &&
					value5 == arr[4] &&
					value6 == arr[5]
				) {
					window.location.href = "{{ route("verified", ["email" => $email]) }}";

				} else {
					alert.style.display = 'block';
					setTimeout(function() {
						var value1 = document.getElementById("input1");
						var value2 = document.getElementById("input2");
						var value3 = document.getElementById("input3");
						var value4 = document.getElementById("input4");
						var value5 = document.getElementById("input5");
						var value6 = document.getElementById("input6");
						value1.value = '';
						value2.value = '';
						value3.value = '';
						value4.value = '';
						value5.value = '';
						value6.value = '';
						value1.focus();
						alert.style.display = 'none';
					}, 2000);
				}

			}

			$(document).ready(function() {
				$("#idForm").on("submit", function(e) {
					e.preventDefault();
					var form = $(this);
					var actionUrl = form.attr('action');
					var formData = form.serialize();
					$.ajax({
						type: "POST",
						url: actionUrl,
						data: formData,
						success: function(response) {
							if (response) {

								if (response.gRecaptchaErrors || response.errorEmail) {

									document.getElementById("captcha").innerHTML = response
										.gRecaptchaErrors;

									document.getElementById("email").innerHTML = response
										.errorEmail;
								} else {
									arr = '';
									timeLeft = 60;
									arr = response.randomNumbers;
									alert('Mã mới đang được gữi');
								}
							}
						},

					});
				});
				$('#showdButton').click(function() {
					document.getElementById("captcha-ob").style.display = 'block';
					document.getElementById("sendButton").style.display = 'block';
					document.getElementById("showdButton").style.display = 'none';
				});
			});
		</script>
	@endpush
@endonce
