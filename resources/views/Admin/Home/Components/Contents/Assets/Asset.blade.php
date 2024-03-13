@extends("Admin.Home.Layout.app")
@section("header")
	<link href="/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link type="text/css" href="/plugins/multiselect/css/multi-select.css" rel="stylesheet" />
	<link type="text/css" href="/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
	<link href="/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link type="text/css" href="/plugins/multiselect/css/multi-select.css" rel="stylesheet" />
	<link type="text/css" href="/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

	<script src="/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

	<script src="/plugins/autocomplete/countries.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/plugins/switchery/switchery.min.css" rel="stylesheet">
@endsection
@section("content")
	<div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
				<h4 class="page-title">Assets</h4>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<div class="row" style="display: flex;justify-content: center;">

					<ul class="nav nav-tabs tabs-bordered nav-justified">
						<li class="active" id="user">
							<a data-toggle="tab" href="#location1" aria-expanded="true">
								<span class="visible-xs"><i class="fa fa-home"></i></span>
								<span class="hidden-xs">Assets</span>
							</a>
						</li>
						<li class="" id="role">
							<a data-toggle="tab" href="#department1" aria-expanded="false">
								<span class="visible-xs"><i class="fa fa-user"></i></span>
								<span class="hidden-xs">QR Codes</span>
							</a>
						</li>
					</ul>
				</div>

				<div class="tab-content">
					<div class="tab-pane active" id="location1">
						<div class="row" style="display: flex;justify-content: right;margin:5px;">
							<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"
								style="margin:10px">
								NEW ASSET
							</button>
						</div>
						<table class="table-striped table-colored table-info table" id="datatable">
							<thead>
								<tr>
									<th>NO.</th>
									<th>CODE</th>
									<th>NAME</th>
									<th>LOCATION</th>
									<th>CONDITION</th>
									<th>PURCHASE</th>
									<th>PRICE</th>
									<th>NOTES</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($assets as $item)
									<tr>
										<td id="idAsset">{{ $item["id"] }}</td>
										<td id="serial">{{ $item["serial"] }}</td>
										<td id="asset_name">{{ $item["asset_name"] }}</td>
										<td>{{ $item["location"]["location_name"] }}</td>
										<td id="">
											@if ($item["condition"] == 0)
												NON-EXISTENT
											@elseif ($item["condition"] == 1)
												VERRY GOOD
											@elseif ($item["condition"] == 2)
												GOOD
											@elseif ($item["condition"] == 3)
												FAIR
											@elseif ($item["condition"] == 4)
												REQUIRES RENEWAL
											@elseif ($item["condition"] == 5)
												UNSERVICEABLE
											@endif
										</td>
										<td>
											Date:{{ $item["date"] }} <br>
											Warranty:{{ $item["warranty"] }} <br>
											Model:{{ $item["modelof_manuf_id"] }} <br>
											Serial:{{ $item["serial"] }} <br>
											Vender:{{ $item["supplier"]["supplier_name"] }}
										</td>
										<td id="priceAsset">{{ $item["price"] }}</td>
										<td id="noteAsset">{{ $item["note"] }}</td>
										<td style="display: flex;flex-wrap: wrap;justify-content: center;gap: 3px;">
											@can("edit-location")
												<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
													data-target=".bs-example-modal-lg1" onclick="editRowAsset(this)">Edit</button>
											@endcan

											<button class="btn btn-info waves-effect waves-light copy-button" type="button" style="width: 70px;"
												onclick="copyRow(this)">Copy</button>
											@can("delete-location")
												<form class="formDelete" action="{{ route("asset.destroy", $item["id"]) }}" method="POST">
													@csrf
													@method("DELETE")
													<button class="btn btn-danger btn-bordered waves-effect waves-light" type="submit">Delete</button>
												</form>
											@endcan

										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="department1">
						<div class="row" style="display: flex;justify-content: right;margin:5px;">
							<button class="btn btn-primary waves-effect waves-light" id="printQRCode" data-toggle="modal"
								data-target="#full-width-modal" style="margin:10px">
								PRINT LABELS
							</button>
						</div>
						<table class="table-striped table-colored table-info table" id="datatableQR">
							<tbody id="TableBody">
								@foreach ($assets as $item)
									<tr style="border: 1px solid black;">
										<td style="width:50%;width: 50%;font-size: 17px;padding-left: 200px;">
											<p>
												<b
													style="font-size: 24px; color: black;">{{ $item["modelof_mannuf"]["manufaturer"]["manuf_name"] }}</b><br>
												Asset Code: {{ $item["id"] }}<br>
												Date Purchased: {{ $item["date"] }}<br>
												Warranty: {{ $item["warranty"] }}<br>
												Vendor: {{ $item["supplier"]["supplier_name"] }}<br>
												Model/Serial: {{ $item["modelof_mannuf"]["model_name"] }} / {{ $item["serial"] }}<br>
												Location/Department: {{ $item["location"]["location_name"] }} /
												{{ $item["location"]["department"]["department_name"] }}
											</p>
										</td>
										@php
											$text = (string) $item["id"] . $item["modelof_mannuf"]["manufaturer"]["manuf_name"] . $item["date"] . $item["warranty"] . $item["supplier"]["supplier_name"] . $item["modelof_mannuf"]["model_name"] . $item["serial"] . $item["location"]["location_name"] . $item["location"]["department"]["department_name"];
										@endphp
										<td style="width:50%;padding-right:200px;text-align:right;">
											<p id="qrcode-container">{!! QrCode::size(166, 6)->generate($text) !!}</p>
											<button class="btn btn-primary" id="generateQRCode" style="margin-right:33px;">Chang Code</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>
	</div>
	{{-- modal new asset --}}
	<div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
		tabindex="-1" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myLargeModalLabel">NEW Asset</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-success alert-dismissible fade in" id="alert-success" role="alert"
						style="position:sticky; top:20px;display:none;">
						<div id="mess"></div>
					</div>
					<form id="idFormNewUser" data-parsley-validate="" action="{{ route("asset.store") }}" novalidate=""
						method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">

								@csrf
								<div class="form-group">
									<input class="form-control" id="idAsset" name="asset_name" type="text" parsley-trigger="change"
										placeholder="NAME">
								</div>
								<div class="text-danger m-3" id="error_username"></div>
								<div class="form-group">
									<input class="form-control" id="idCategory" name="category" type="text" parsley-trigger="change"
										placeholder="CATEGORY">
								</div>
								<div class="text-danger m-3" id="error_email"></div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectLocation" name="location_model_id" tabindex="-98">
											<option value="0">SELECT LOCATION</option>
											@foreach ($locations as $item)
												<option value="{{ $item["id"] }}">{{ $item["location_name"] }}
													#{{ $item["department"]["department_name"] }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="text-danger m-3" id="error_phone"></div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="roleOption" name="condition" tabindex="-98">
											<option value="1">NON-EXISTENT</option>
											<option value="2">VERRY GOOD</option>
											<option value="3">GOOD</option>v
											<option value="4">FAIR</option>
											<option value="5">REQUIRES RENEWAL</option>
											<option value="6">UNSERVICEABLE</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectSupplier" name="supplier_model_id" tabindex="-98">
											<option value="0">SELECT SUPPLIER</option>
											@foreach ($suppliers as $item)
												<option value="{{ $item["id"] }}">{{ $item["supplier_name"] }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectManufacturer" name="modelof_manuf_id" tabindex="-98">
											<option value="0">SELECT MANUFACTURER</option>
											@foreach ($manufacturers as $item)
												<option value="{{ $item["id"] }}">{{ $item["manuf_name"] }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectModel" name="modelof_manuf_id" tabindex="-98">
											<option value="0">SELECT MODEL</option>
										</select>
									</div>
								</div>
								<div class="text-danger m-3" id="error_role"></div>

								<div class="text-danger m-3" id="error_selectDepartment"></div>

							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" id="idPrice" name="price" type="text" placeholder="PRICE">
								</div>
								<div class="form-group">
									<textarea class="form-control" id="note_edit" name="note" rows="7" placeholder="Notes"></textarea>
								</div>
								<div class="text-danger m-3" id="error_location_model_id"></div>
								<div class="form-group">
									<input class="form-control" id="idSerial" name="serial" type="text" parsley-trigger="change"
										placeholder="SERIAL">
								</div>

								<div class="row" style="margin-bottom: 7px">
									<div class="col-md-6">
										<div class="input-group">
											<input class="form-control" id="datepicker" name="date" type="text" placeholder="mm/dd/yyyy">
											<span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
										</div>
									</div>
									<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix"
											style="display: none;">
										</span>
										<input class="vertical-spin form-control" name="warranty" type="text" value=""
											style="display: block;" placeholder="WARRANTY (MONTHS)">

									</div>
								</div>
							</div>

						</div>
						<hr>
						<div class="row">
							<div class="col-md-6" style="text-align: center;">
								<button class="btn btn-primary waves-effect waves-light" type="submit" style="width:80%">
									CREATE ASSET
								</button>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<button class="btn btn-default waves-effect" id="cancel" type="reset" style="width:80%">
									Cancel
								</button>
							</div>
						</div>

					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	{{-- modal edit asset --}}
	<div class="modal fade bs-example-modal-lg1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
		tabindex="-1" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myLargeModalLabel">NEW Asset</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-success alert-dismissible fade in" id="alert-success" role="alert"
						style="position:sticky; top:20px;display:none;">
						<div id="mess"></div>
					</div>
					<form id="idFormNewUser" data-parsley-validate="" action="{{ route("asset.update", [1]) }}" novalidate=""
						method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<input id="idedit" name="id" type="hidden" value="your-hidden-id-value">
								@method("PUT")
								@csrf
								<div class="form-group">
									<input class="form-control" id="asset_name_edit" name="asset_name" type="text" parsley-trigger="change"
										placeholder="NAME">
								</div>
								<div class="text-danger m-3" id="error_username"></div>
								<div class="form-group">
									<input class="form-control" id="idCategory" name="category" type="text" parsley-trigger="change"
										placeholder="CATEGORY">
								</div>
								<div class="text-danger m-3" id="error_email"></div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectLocation" name="location_model_id" tabindex="-98">
											<option value="0">SELECT LOCATION</option>
											@foreach ($locations as $item)
												<option value="{{ $item["id"] }}">{{ $item["location_name"] }}
													#{{ $item["department"]["department_name"] }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="text-danger m-3" id="error_phone"></div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="roleOption" name="condition" tabindex="-98">
											<option value="1">NON-EXISTENT</option>
											<option value="2">VERRY GOOD</option>
											<option value="3">GOOD</option>v
											<option value="4">FAIR</option>
											<option value="5">REQUIRES RENEWAL</option>
											<option value="6">UNSERVICEABLE</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control" id="noteAsset_edit" name="note" rows="5" placeholder="Notes"></textarea>
								</div>
								<div class="text-danger m-3" id="error_role"></div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectManufacturer" name="modelof_manuf_id" tabindex="-98">
											<option value="0">SELECT MANUFACTURER</option>
											@foreach ($manufacturers as $item)
												<option value="{{ $item["id"] }}">{{ $item["manuf_name"] }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectModelEdit" name="modelof_manuf_id" tabindex="-98">
											<option value="0">SELECT MODEL</option>
										</select>
									</div>
								</div>
								<div class="text-danger m-3" id="error_location_model_id"></div>
								<div class="form-group">
									<input class="form-control" id="serial_edit" name="serial" type="text" parsley-trigger="change"
										placeholder="SERIAL">
								</div>
								<div class="text-danger m-3" id="error_selectDepartment"></div>
								<div class="row" style="margin-bottom: 7px">
									<div class="col-md-6">
										<div class="input-group">
											<input class="form-control" id="datepicker" name="date" type="text" placeholder="mm/dd/yyyy">
											<span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
										</div>
									</div>
									<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix"
											style="display: none;">
										</span>
										<input class="vertical-spin form-control" name="warranty" type="text" value=""
											style="display: block;" placeholder="WARRANTY (MONTHS)">

									</div>
								</div>

							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" id="priceAsset_edit" name="price" type="text" placeholder="PRICE">
								</div>
								<div class="form-group" style="width: 60%">
									<div class="btn-group bootstrap-select show-tick">
										<select class="selectpicker show-tick" id="selectSupplier" name="supplier_model_id" tabindex="-98">
											<option value="0">SELECT SUPPLIER</option>
											@foreach ($suppliers as $item)
												<option value="{{ $item["id"] }}">{{ $item["supplier_name"] }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<section>
									<div class="container">
										<div class="carousel">
											<input id="slide-1" name="slides" type="radio" checked="checked">
											<input id="slide-2" name="slides" type="radio">
											<input id="slide-3" name="slides" type="radio">
											<input id="slide-4" name="slides" type="radio">
											<input id="slide-5" name="slides" type="radio">
											<input id="slide-6" name="slides" type="radio">
											<ul class="carousel__slides">

												@foreach ($assets as $item)
													@if ($item["image"])
														@php
															$i = 1;
														@endphp
														@foreach ($item["image"] as $itemI)
															<li class="carousel__slide">
																<p class="figcaptionleft">{{ $i++ }}/{{ count($item["image"]) }}</i></p>
																<figcaption><a href=""><i class="glyphicon glyphicon-trash"></i></a></figcaption>
																<figure>
																	<div>
																		<img src="/storage/{{ $item->url }}" alt="">
																	</div>
																</figure>
															</li>
														@endforeach
													@else
														<li class="carousel__slide">
															<p class="figcaptionleft">0</i></p>
															<figcaption><a href=""><i class="glyphicon glyphicon-trash"></i></a></figcaption>
															<figure>
																<div>
																	<img src="" alt="">
																</div>
															</figure>
														</li>
													@endif
												@endforeach

											</ul>
											<ul class="carousel__thumbnails" id="carousel__thumbnails">
												<li>
													<label for="slide-1"><img src="" alt=""></label>
												</li>
												<li>
													<label for="slide-2"><img src="" alt=""></label>
												</li>
												<li>
													<label for="slide-3"><img src="" alt=""></label>
												</li>
												<li>
													<label for="slide-4"><img src="" alt=""></label>
												</li>
												<li>
													<label for="slide-5"><img src="" alt=""></label>
												</li>
												<li>
													<label for="slide-6"><img src="" alt=""></label>
												</li>
											</ul>
										</div>
										<div class="input_container">
											<input id="fileUpload" name="file" type="file" style="width: 100%;">
										</div>
									</div>
								</section>
							</div>

						</div>
						<hr>
						<div class="row">
							<div class="col-md-6" style="text-align: center;">
								<button class="btn btn-primary waves-effect waves-light" type="submit" style="width:80%">
									Edit Asset
								</button>
							</div>
							<div class="col-md-6" style="text-align: center;">
								<button class="btn btn-default waves-effect" id="cancel" type="reset" style="width:80%">
									Cancel
								</button>
							</div>
						</div>

					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	{{-- modal print --}}
	<div class="modal fade" id="full-width-modal" role="dialog" aria-labelledby="full-width-modalLabel"
		aria-hidden="true" tabindex="-1" style="display: none;">
		<div class="modal-dialog modal-full">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
					<div class="row" style="display: flex;justify-content: center;">

						<ul class="nav nav-tabs nav-justified">
							<li class="active" id="user">
								<a data-toggle="tab" href="#select" aria-expanded="true">
									<span class="visible-xs"><i class="fa fa-home"></i></span>
									<span class="hidden-xs">Select Assets</span>
								</a>
							</li>
							<li class="" id="role">
								<a data-toggle="tab" href="#print" aria-expanded="false">
									<span class="visible-xs"><i class="fa fa-user"></i></span>
									<span class="hidden-xs">Print Templates</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box table-responsive">
								<div class="tab-content">
									{{-- SELECT ASSET --}}
									<div class="tab-pane active" id="select">
										<div style="margin-bottom: 50px;">
											<table class="m-0 table">
												<thead>
													<tr>
														<th style="width:60px;">NO.</th>
														<th style="width: 250px;">NAME</th>
														<th style="width: 400px;">LOCATION</th>
														<th style="width: 150px;">ASSET CODE</th>
														<th style="width: 250px;">VENDOR</th>
														<th style="width: 250px;">MODEL/SERIAL</th>
														<th>ACTION</th>
													</tr>
												</thead>
												<tbody id="bodySelectPrint">

												</tbody>
											</table>
										</div>
										<div>
											<table class="m-0 table" id="selectPrint">

												<thead>
													<tr>
														<th style="width:60px;">NO.</th>
														<th style="width: 250px;">NAME</th>
														<th style="width: 400px;">LOCATION</th>
														<th style="width: 150px;">ASSET CODE</th>
														<th style="width: 250px;">VENDOR</th>
														<th style="width: 250px;">MODEL/SERIAL</th>
														<th>ACTION</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($assets as $item)
														<tr>
															<td id="NO">2</td>
															<td id="manufacturer">{{ $item["modelof_mannuf"]["manufaturer"]["manuf_name"] }}</td>
															<td id="location"> {{ $item["location"]["location_name"] }} /
																{{ $item["location"]["department"]["department_name"] }}</td>
															<td id="code">{{ $item["id"] }}</td>
															<td id="supplier">{{ $item["supplier"]["supplier_name"] }}</td>
															<td id="model"> {{ $item["modelof_mannuf"]["model_name"] }} / {{ $item["serial"] }}</td>
															<td id=""><button class="btn btn-success add-button" id="btn-add" onclick="add(this)"><i
																		class="glyphicon glyphicon-plus"></i></button></td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									{{-- PRINT TEMPLATES --}}
									<div class="tab-pane" id="print">
										<div class="row">
											<div class="col-md-5">
												<div style="border: 2px solid #000;padding: 10px;font-size: 25px;color: #000;">
													<div class="row">
														<div class="col-md-10">Asset Name</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkName" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Asset Code</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkCode" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Date Purchased</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkDate" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Warranty</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkWarranty" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Vendor</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkVendor" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Model / Serial</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkModel" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10">Location / Department</div>
														<div class="col-md-2">
															<label class="container_box">
																<input class="checkLocation" name="create-location" type="checkbox" value="7">
																<span class="checkmark1"></span>
															</label>
														</div>
													</div>
												</div>
												<div style="margin: 10px; text-align: center;">
													<button class="btn btn-primary waves-effect waves-light" type="button" style="font-size:25px;">Print
														Now</button>

												</div>
											</div>
											<div class="col-md-7">
												<div class="row">
													<div class="col-md-6">
														<div style="text-align:center;width: 240px;border: 2px solid #ccc;margin: auto;color: black;"><b>Asset
																Details + QR Code</b><br>5 x 2</div>
														<div style="margin: 10px;padding 10px;display: flex;justify-content: space-around;">

															<div style="max-height: 250px; overflow: auto;">
																<table style="border: 2px solid black;width:240px;height:250px">
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																</table>
															</div>
															<div
																style="position: absolute; border: 1px solid #ccc; margin-top: 96px; padding: 10px 20px 10px 20px;border-radius: 5px;background-color: white;font-size: 26px;">
																x10</div>

														</div>
														<div class="checkbox checkbox-primary checkbox-single checkbox-circle" style="text-align: center;">
															<input class="check10" id="singleCheckbox21" type="checkbox" value="option2"
																aria-label="Single checkbox Two" style="width:25px;height:25px;">
															<label></label>
														</div>
													</div>
													<div class="col-md-6">
														<div style="text-align:center;width: 240px;border: 2px solid #ccc;margin: auto;color: black;"><b>Asset
																Details + QR Code</b><br>8 x 3</div>
														<div style="margin: 10px;padding 10px;display: flex;justify-content: space-around;">
															<div style="max-height: 250px; overflow: auto;">
																<table style="border: 2px solid black;width:240px;height:250px">
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																</table>
															</div>
															<div
																style="position: absolute; border: 1px solid #ccc; margin-top: 96px; padding: 10px 20px 10px 20px;border-radius: 5px;background-color: white;font-size: 26px;">
																x21</div>

														</div>
														<div class="checkbox checkbox-primary checkbox-single checkbox-circle" style="text-align: center;">
															<input class="check21" id="singleCheckbox21" type="checkbox" value="option2"
																aria-label="Single checkbox Two" style="width:25px;height:25px;">
															<label></label>
														</div>
													</div>
													<div class="col-md-6">
														<div style="text-align:center;width: 240px;border: 2px solid #ccc;margin: auto;color: black;"><b>Asset
																Details + QR Code</b><br>8 x 3</div>
														<div style="margin: 10px;padding 10px;display: flex;justify-content: space-around;">
															<div style="max-height: 250px; overflow: auto;">
																<table style="border: 2px solid black;width:240px;height:250px">
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																</table>
															</div>
															<div
																style="position: absolute; border: 1px solid #ccc; margin-top: 96px; padding: 10px 20px 10px 20px;border-radius: 5px;background-color: white;font-size: 26px;">
																x24</div>

														</div>
														<div class="checkbox checkbox-primary checkbox-single checkbox-circle" style="text-align: center;">
															<input class="check24" id="singleCheckbox21" type="checkbox" value="option2"
																aria-label="Single checkbox Two" style="width:25px;height:25px;">
															<label></label>
														</div>
													</div>
													<div class="col-md-6">
														<div style="text-align:center;width: 240px;border: 2px solid #ccc;margin: auto;color: black;"><b>Asset
																Details + QR Code</b><br>8 x 5</div>
														<div style="margin: 10px;padding 10px;display: flex;justify-content: space-around;">
															<div style="max-height: 250px; overflow: auto;">
																<table style="border: 2px solid black;width:240px;height:250px">
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																	<tr style="border: 2px solid black;">
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																		<th style="border: 2px solid black;"></th>
																	</tr>
																</table>
															</div>
															<div
																style="position: absolute; border: 1px solid #ccc; margin-top: 96px; padding: 10px 20px 10px 20px;border-radius: 5px;background-color: white;font-size: 26px;">
																x40</div>

														</div>
														<div class="checkbox checkbox-primary checkbox-single checkbox-circle" style="text-align: center;">
															<input class="check40" id="singleCheckbox21" type="checkbox" value="option2"
																aria-label="Single checkbox Two" style="width:25px;height:25px;">
															<label></label>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
@endsection
@once
	@push("scripts")
		<script src="/plugins/switchery/switchery.min.js"></script>

		<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
		<script src="/plugins/datatables/dataTables.buttons.min.js"></script>
		<script src="/plugins/datatables/buttons.bootstrap.min.js"></script>
		<script src="/plugins/datatables/jszip.min.js"></script>
		<script src="/plugins/datatables/pdfmake.min.js"></script>
		<script src="/plugins/datatables/vfs_fonts.js"></script>
		<script src="/plugins/datatables/buttons.html5.min.js"></script>
		<script src="/plugins/datatables/buttons.print.min.js"></script>
		<script src="/plugins/datatables/dataTables.fixedHeader.min.js"></script>
		<script src="/plugins/datatables/dataTables.keyTable.min.js"></script>
		<script src="/plugins/datatables/dataTables.responsive.min.js"></script>
		<script src="/plugins/datatables/responsive.bootstrap.min.js"></script>
		<script src="/plugins/datatables/dataTables.scroller.min.js"></script>
		<script src="/plugins/datatables/dataTables.colVis.js"></script>
		<script src="/plugins/datatables/dataTables.fixedColumns.min.js"></script>
		<script src="/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>

		<script src="/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
		<script src="/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>

		<script src="/plugins/moment/moment.js"></script>
		<script src="/plugins/timepicker/bootstrap-timepicker.js"></script>
		<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
		<script src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
		<script src="/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="/assets/pages/jquery.form-pickers.init.js"></script>
		<script src="/assets/pages/jquery.form-advanced.init.js"></script>
		<script src="/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>

		<script src="/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
		<script src="/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
		<script src="/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
		<script src="/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

		<script src="/plugins/autocomplete/jquery.mockjax.js"></script>
		<script src="/plugins/autocomplete/jquery.autocomplete.min.js"></script>
		<script src="/plugins/autocomplete/countries.js"></script>
		<script src="/assets/pages/jquery.autocomplete.init.js"></script>

		<script src="/assets/pages/jquery.form-advanced.init.js"></script>

		<!-- App js -->
		<script src="/assets/js/jquery.core.js"></script>
		<script src="/assets/js/jquery.app.js"></script>
		<script>
			$('#datatable').dataTable();
			$('#selectPrint').dataTable();
			$('#selectManufacturer').on("change", function() {
				var selectedValue = $(this).val();
				$('#selectModel').find('option:not(:first)').remove();
				$.ajax({
					type: "GET",
					url: '{{ route("asset.show", ["asset" => ":selectedValue"]) }}'.replace(
						':selectedValue', selectedValue),
					success: function(response) {
						var option = '<option value="' + response.modelof_manuf[0].id + '">' +
							response.modelof_manuf[0].model_name +
							'</option>';
						$("#selectModel").append(option);
						$("#selectModel").selectpicker("refresh");
						$("#selectModelEdit").append(option);
						$("#selectModelEdit").selectpicker("refresh");
					}
				})
			});
			$('#selectManufacturerEdit.').on("change", function() {
				var selectedValue = $(this).val();
				$('#selectModel').find('option:not(:first)').remove();
				$.ajax({
					type: "GET",
					url: '{{ route("asset.show", ["asset" => ":selectedValue"]) }}'.replace(
						':selectedValue', selectedValue),
					success: function(response) {
						var option = '<option value="' + response.modelof_manuf[0].id + '">' +
							response.modelof_manuf[0].model_name +
							'</option>';
						$("#selectModelEdit").append(option);
						$("#selectModelEdit").selectpicker("refresh");
					}
				})
			});
			$("#carousel__thumbnails li").each(function() {
				var $img = $(this).find("img");
				if ($img.attr("src") === "") {
					$(this).hide();
				}
			});

			function add(button) {
				var NO = button.closest('tr').querySelector('#NO').textContent;
				var manufacturer = button.closest('tr').querySelector('#manufacturer').textContent;
				var location = button.closest('tr').querySelector('#location').textContent;
				var code = button.closest('tr').querySelector('#code').textContent;
				var supplier = button.closest('tr').querySelector('#supplier').textContent;
				var model = button.closest('tr').querySelector('#model').textContent;

				var tr = `<tr>` +
					'<td>' + NO + '</td>' +
					'<td>' + manufacturer + '</td>' +
					'<td>' + location + '</td>' +
					'<td>' + code + '</td>' +
					'<td>' + supplier + '</td>' +
					'<td>' + model + '</td>' +
					'<td><button class="btn btn-danger" onclick="removeRow(this)">' +
					'<i class="glyphicon glyphicon-trash"></i>' +
					'</button>' +
					'</td>' +
					'</tr>';

				$('#bodySelectPrint').append(tr);

			}

			function removeRow(button) {
				var row = $(button).closest('tr');
				row.remove();
			}

			function editRowAsset(button) {
				var idAsset = button.closest('tr').querySelector('#idAsset').textContent;
				var serial = button.closest('tr').querySelector('#serial').textContent;
				var asset_name = button.closest('tr').querySelector('#asset_name').textContent;
				var priceAsset = button.closest('tr').querySelector('#priceAsset').textContent;
				var noteAsset = button.closest('tr').querySelector('#noteAsset').textContent;
				document.getElementById('idedit').value = idAsset;
				document.getElementById('serial_edit').value = serial;
				document.getElementById('asset_name_edit').value = asset_name;
				document.getElementById('priceAsset_edit').value = priceAsset;
				document.getElementById('noteAsset_edit').value = noteAsset;
			}
		</script>
	@endpush
@endonce
