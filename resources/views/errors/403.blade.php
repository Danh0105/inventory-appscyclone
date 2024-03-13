@extends("Admin.Auth.Layout.app")
@section("content")
	<div class="col-sm-12 text-center">

		<div class="wrapper-page">
			<img src="assets/images/animat-search-color.gif" alt="" height="120">
			<h2 class="text-uppercase text-danger">Đường dẫn đã hết hạn</h2>
			<p class="text-muted">Đường dẫn được cung cấp cho việc đổi mật khẩu chỉ có hiệu lực 60s, vui lòng chọn
				<b>GET LINK</b> để nhận link mới. Trân trọng cảm ơn!
			</p>

			<a class="btn btn-success waves-effect waves-light m-t-20" href="{{ route("re.password") }}">Get link</a>
		</div>

	</div>
@endsection
