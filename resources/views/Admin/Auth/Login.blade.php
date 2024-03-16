@extends('Admin.Auth.Layout.app')
@section('content')
    <div class="col-sm-12" style="margin-bottom: 50px;">
        <div class="wrapper-page">
            <div class="m-t-40 account-pages">
                <div class="account-logo-box text-center">
                    <h2 class="text-uppercase">
                        <a class="text-success" href="index.html">
                            <span>LOGIN TO YOUR ACCOUNT</span>
                        </a>
                    </h2>
                </div>
                <div class="account-content">
                    <form class="form-horizontal" id="idForm" action="{{ route('api.login') }}" method="post">
                        @csrf
                        @if (session('messs'))
                            <div class="alert alert-danger">
                                {{ session('messs') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="email" required=""
                                    placeholder="Email(danh010500@gmail.com)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" required=""
                                    placeholder="Password(nguyendanh4)">
                            </div>
                        </div>

                        <div class="form-group m-t-30 text-center">
                            <div class="col-sm-12">
                                <a class="text-muted" href="{{ route('re.password') }}"><i
                                        class="fa fa-lock m-r-5"></i>{{ __(' Forgot your password?') }}</a>
                            </div>
                        </div>

                        <div class="form-group account-btn m-t-10 text-center">
                            <div class="col-xs-12">
                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                    type="submit">{{ __('LOGIN') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row m-t-50">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">OR <a class="text-primary m-l-5" href="{{ route('register') }}"><b>
                                {{ __('CREATE ACCOUNT') }}</b></a></p>
                </div>
            </div>
        </div>
    </div>
    @once
        @push('scripts')
            {{-- <script>
				$("#idForm").on("submit", function(e) {
					e.preventDefault();
					var form = $(this);
					var actionUrl = form.attr('action');
					var formData = form.serialize();
					$.ajax({
						type: "POST",
						url: actionUrl,
						data: formData,
						success: function(data) {
							console.log(data);
						},
						error: function(error) {
							console.error("Error occurred:", error);
						}
					});
				});
			</script> --}}
        @endpush
    @endonce
@endsection
