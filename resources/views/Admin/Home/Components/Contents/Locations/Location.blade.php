@extends("Admin.Home.Layout.app")
@section("header")
				<link href="/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
				<link type="text/css" href="/plugins/multiselect/css/multi-select.css" rel="stylesheet" />
				<link type="text/css" href="/plugins/select2/css/select2.min.css" rel="stylesheet" />
				<link href="/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
				<link href="/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
				<link href="/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" />
				<meta name="csrf-token" content="{{ csrf_token() }}">
				<link href="/plugins/switchery/switchery.min.css" rel="stylesheet">
@endsection

{{-- @can("view-location") --}}
@section("content")
				<div class="row">
								<div class="col-xs-12">
												<div class="page-title-box">
																<h4 class="page-title">Locations</h4>
																<div class="clearfix"></div>
												</div>
								</div>
				</div>
				@if (Session::has("error_import"))
								<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
												<button class="close" data-dismiss="alert" type="button" aria-label="Close">
																<span aria-hidden="true">×</span>
												</button>
												<i class="mdi mdi-block-helper"></i>
												{{ Session::get("error_import") }}
								</div>
				@endif
				<div class="row">
								<div class="col-sm-12">
												<div class="card-box table-responsive">
																<div class="row" style="display: flex;justify-content: center;">

																				<ul class="nav nav-tabs tabs-bordered nav-justified">
																								<li class="active">
																												<a data-toggle="tab" href="#location1" aria-expanded="true">
																																<span class="visible-xs"><i class="fa fa-home"></i></span>
																																<span class="hidden-xs">Locations</span>
																												</a>
																								</li>
																								<li class="">
																												<a data-toggle="tab" href="#department1" aria-expanded="false">
																																<span class="visible-xs"><i class="fa fa-user"></i></span>
																																<span class="hidden-xs">Departments</span>
																												</a>
																								</li>

																				</ul>
																</div>
																<div class="row" style="display: flex;justify-content: right;margin:5px;">
																				@can("create-location")
																								<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
																												data-target=".bs-example-modal-lg" style="margin:10px">
																												NEW LOCATION
																								</button>
																				@endcan
																				@can("create-location")
																								<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"
																												style="margin:10px">IMPORT
																												LOCATION</button>
																				@endcan
																</div>
																<div class="tab-content">
																				<div class="tab-pane active" id="location1">
																								<table class="table-striped table-colored table-info table" id="datatable">
																												<thead>
																																<tr>
																																				<th>NO</th>
																																				<th>NAME</th>
																																				<th>ADDRESS</th>
																																				<th>NOTES</th>
																																				<th></th>

																																</tr>
																												</thead>

																												<tbody id="TableBody">

																																@foreach ($locations as $item)
																																				<tr>
																																								<td id="id">{{ $item["id"] }}</td>
																																								<td>
																																												<p id="name">{{ $item["location_name"] }}</p>
																																												{{ $item["department"]["department_name"] ?? "" }}
																																								</td>
																																								<td id="department" style="width: 500px;word-wrap:break-word;">
																																												{{ $item["department"]["floor"] ?? "" }},
																																												{{ $item["department"]["unit"] ?? "" }},
																																												{{ $item["department"]["building"] ?? "" }},
																																												{{ $item["department"]["street_address"] ?? "" }},
																																												{{ $item["department"]["city_name"] ?? "" }},
																																												{{ $item["department"]["state_name"] ?? "" }},
																																												{{ $item["department"]["country"] ?? "" }},
																																												{{ $item["department"]["zip_code"] ?? "" }}
																																								</td>
																																								<td>
																																												<p id="note">{{ $item["note"] }}</p>
																																								</td>
																																								<td style="display: flex;flex-wrap: wrap;justify-content: center;gap: 3px;">
																																												@can("edit-location")
																																																<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
																																																				data-target="#custom-width-modal" onclick="editRow(this)">Edit</button>
																																												@endcan

																																												<button class="btn btn-info waves-effect waves-light copy-button" type="button"
																																																style="width: 70px;" onclick="copyRow(this)">Copy</button>
																																												@can("delete-location")
																																																<form class="formDelete" action="{{ route("locations.destroy", $item["id"]) }}"
																																																				method="POST">
																																																				@csrf
																																																				@method("DELETE")
																																																				<button class="btn btn-danger btn-bordered waves-effect waves-light"
																																																								type="submit">Delete</button>
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
																												<p>This is not my task</p>
																												{{-- 		<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
																																data-target=".bs-example-modal-lg" style="margin:10px">
																																NEW DEPARTMENT
																												</button>
																												<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
																																data-target="#myModal" style="margin:10px">IMPORT
																																DEPARTMENT
																												</button> --}}
																								</div>
																				</div>
																</div>

												</div>

								</div>
				</div>
				{{-- model --}}
				<div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
								tabindex="-1" style="display: none;">
								<div class="modal-dialog">
												<div class="modal-content">
																<div class="modal-header">
																				<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
																				<h4 class="modal-title" id="myLargeModalLabel">NEW DEPARTMENT</h4>
																</div>
																<div class="modal-body">
																				<div class="alert alert-success alert-dismissible fade in" id="alert-success" role="alert"
																								style="position:sticky; top:20px;display:none;">
																								<div id="mess"></div>
																				</div>
																				<form id="idForm" data-parsley-validate="" action="{{ route("locations.store") }}"
																								novalidate="">
																								@csrf
																								<div class="form-group">
																												<input class="form-control" id="location_name" name="location_name" type="text"
																																parsley-trigger="change" placeholder="Department name">
																								</div>
																								<div class="text-danger m-3" id="error_location"></div>
																								<div class="row">
																												<div class="form-group col-md-4">
																																<input class="form-control" type="number" id="floot" placeholder="Floot">
																												</div>
																												<div class="form-group col-md-4">
																																<input class="form-control" type="number" id="unit" placeholder="Unit">
																												</div>
																												<div class="form-group col-md-4">
																																<input class="form-control" type="number" id="zip_code" placeholder="Zip code">
																												</div>
																								</div>
																								<div class="form-group">
																												<input class="form-control" type="text" id="building" placeholder="Building">
																								</div>
																								<div class="form-group">
																												<input class="form-control" type="text" id="street_address" placeholder="Street address">
																								</div>
																								<div class="form-group">
																												<input class="form-control" type="text" id="city_name" placeholder="City name">
																								</div>
																								<div class="form-group">
																												<input class="form-control" type="text" id="state_name" placeholder="State name">
																								</div>
																								<div class="form-group">
																												<input class="form-control" type="text" id="country" placeholder="Contry">
																								</div>

																								<hr>
																								<div class="row">
																												<div class="col-md-6" style="text-align: center;">
																																<button class="btn btn-primary waves-effect waves-light" type="submit"
																																				style="width:80%">
																																				CREATE DEPARTMENT
																																</button>
																												</div>
																												<div class="col-md-6" style="text-align: center;">
																																<button class="btn btn-default waves-effect" id="cancel" type="reset"
																																				style="width:80%">
																																				Cancel
																																</button>
																												</div>
																								</div>

																				</form>
																</div>
												</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
				</div>
				<!--Model edit -->
				<div class="modal fade" id="custom-width-modal" role="dialog" aria-labelledby="custom-width-modalLabel"
								aria-hidden="true" tabindex="-1">
								<div class="modal-dialog">
												<div class="modal-content">
																<div class="modal-header">
																				<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
																				<h4 class="modal-title" id="myLargeModalLabel">NEW LOCATION</h4>
																</div>
																<div class="modal-body">
																				<form id="idFormEdit" data-parsley-validate="" action="{{ route("locations.update", [0]) }}"
																								novalidate="" method="POST">
																								@csrf
																								@method("PUT")
																								<input id="idedit" name="id" type="hidden" value="your-hidden-id-value">
																								<div class="form-group">
																												<input class="form-control" id="location_name_edit" name="location_name" type="text"
																																parsley-trigger="change" placeholder="Location name">
																								</div>
																								<div class="text-danger m-3" id="error_locationEdit"></div>
																								<div class="form-group">
																												<textarea class="form-control" id="note_edit" name="note" rows="5" placeholder="Notes"></textarea>
																								</div>
																								<div class="form-group" style="width: 60%">
																												<div class="btn-group bootstrap-select show-tick">
																																<select class="selectpicker show-tick" id="selectDepartmentEdit"
																																				name="department_model_id_edit" tabindex="-98">
																																				<option value="0">Select Departments</option>
																																				@foreach ($departments as $item)
																																								<option value="{{ $item["id"] }}">{{ $item["department_name"] }}</option>
																																				@endforeach
																																</select>
																												</div>
																								</div>
																								<div class="text-danger m-3" id="error_selectDepartmentEdit"></div>
																								<div id="showdepartmentEdit" style="display: none;">
																												<div class="row">
																																<div class="col-md-6">
																																				<div class="form-group">
																																								<input class="form-control" id="floorEdit" name="floor" type="text"
																																												readonly parsley-trigger="change" required="" placeholder="FLOOR">
																																				</div>

																																</div>
																																<div class="col-md-6">
																																				<div class="form-group">
																																								<input class="form-control" id="unitEdit" name="unit" readonly
																																												placeholder="UNIT">
																																				</div>
																																</div>
																												</div>
																												<div class="form-group">
																																<input class="form-control" id="buildingEdit" name="building" type="text" readonly
																																				parsley-trigger="change" required="" placeholder="BUILDING">
																												</div>
																												<div class="form-group">
																																<input class="form-control" id="addressEdit" name="address" type="text" readonly
																																				parsley-trigger="change" required="" placeholder="STREET ADDRESS">
																												</div>
																												<div class="form-group">
																																<input class="form-control" id="cityEdit" name="city" type="text" readonly
																																				parsley-trigger="change" required="" placeholder="CITY">
																												</div>
																												<div class="form-group">
																																<input class="form-control" id="stateEdit" name="state" type="text" readonly
																																				parsley-trigger="change" required="" placeholder="STATE">
																												</div>
																												<div class="row">
																																<div class="col-md-6">
																																				<div class="form-group">
																																								<select class="selectpicker show-tick" id="countryEdit" name="country"
																																												tabindex="-98">
																																												<option>COUNTRY</option>
																																												<option>HCM</option>
																																												<option>Cà Mau</option>
																																												<option>Lào Cai</option>
																																								</select>
																																				</div>

																																</div>
																																<div class="col-md-6">
																																				<div class="form-group">
																																								<input class="form-control" id="zipcodeEdit" name="zipcode" type="text"
																																												readonly parsley-trigger="change" required="" placeholder="ZIP CODE">
																																				</div>
																																</div>
																												</div>
																								</div>
																								<hr>
																								<div class="row">
																												<div class="col-md-6" style="text-align: center;">
																																<button class="btn btn-primary waves-effect waves-light" type="submit"
																																				style="width:80%">
																																				EDIT
																																</button>
																												</div>
																												<div class="col-md-6" style="text-align: center;">
																																<button class="btn btn-default waves-effect" id="cancel" type="reset"
																																				style="width:80%">
																																				CANCEL
																																</button>
																												</div>
																								</div>

																				</form>
																</div>
												</div>
								</div><!-- /.modal-dialog -->
				</div>
				<!-- Model import -->
				<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
								tabindex="-1">
								<div class="modal-dialog">
												<div class="modal-content">
																<div class="modal-header">
																				<button class="close" data-dismiss="modal" type="button" aria-hidden="true">×</button>
																				<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
																</div>
																<form action="{{ route("locations.store") }}" method="POST" enctype="multipart/form-data">
																				@csrf
																				<div class="modal-body">
																								<div class="input_container">
																												<input id="fileUpload" name="file" type="file" style="width: 100%;">
																								</div>
																								<div style="margin-top:10px;font-size:18px;">
																												<p>Accepted files (click to download sample) </p>
																								</div>
																								<ul>
																												<li style="color: rgba(0, 0, 255, 0.901)">CSV (.csv)</li>
																												<li style="color: rgba(0, 0, 255, 0.901)">EXCEL (.xlsx)</li>
																								</ul>
																				</div>
																				<div class="modal-footer">
																								<button class="btn btn-default waves-effect" type="reset">Cancel</button>
																								<button class="btn btn-primary waves-effect waves-light" type="submit">Import</button>
																				</div>
																</form>
												</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
				</div>
@endsection
{{-- @endcan --}}
@cannot("view-location")
				@section("content")
								<div style="height: 100%;display: flex;justify-content: center;">
												<h3 style="color:#a8a1a1;margin-top: 280px">you do not have permission</h3>
								</div>
				@endsection
@endcan
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
								<script src="/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
								<script src="/plugins/multiselect/js/jquery.multi-select.js"></script>
								<script src="/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
								<script src="/plugins/select2/js/select2.min.js"></script>
								<script src="/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
								<script src="/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
								<script src="/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
								<script src="/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
								<script src="/plugins/autocomplete/jquery.mockjax.js"></script>
								<script src="/plugins/autocomplete/jquery.autocomplete.min.js"></script>
								<script src="/plugins/autocomplete/countries.js"></script>

								<!-- App js -->
								<script src="/assets/js/jquery.core.js"></script>
								<script src="/assets/js/jquery.app.js"></script>
								<script>
												$('#datatable').dataTable({
																"order": [
																				[0, "desc"]
																]
												});
												$('#selectDepartment').on("change", function() {
																var selectedValue = $(this).val();
																$.ajax({
																				type: "GET",
																				url: '{{ route("locations.show", ["location" => ":selectedValue"]) }}'.replace(
																								':selectedValue', selectedValue),
																				success: function(response) {
																								if (response) {
																												$('#floor').val(response.floor);
																												$('#unit').val(response.unit);
																												$('#building').val(response.building);
																												$('#address').val(response.street_address);
																												$('#city').val(response.city_name);
																												$('#state').val(response.state_name);
																												$('#country').val(response.country);
																												$('#zipcode').val(response.zip_code);
																								}
																				}
																})
																$('#showdepartment').css("display", "block");
												});
												$('#selectDepartmentEdit').on("change", function() {
																var selectedValue = $(this).val();
																$.ajax({
																				type: "GET",
																				url: '{{ route("locations.show", ["location" => ":selectedValue"]) }}'.replace(
																								':selectedValue', selectedValue),
																				success: function(response) {
																								if (response) {
																												$('#floorEdit').val(response.floor);
																												$('#unitEdit').val(response.unit);
																												$('#buildingEdit').val(response.building);
																												$('#addressEdit').val(response.street_address);
																												$('#cityEdit').val(response.city_name);
																												$('#stateEdit').val(response.state_name);
																												$('#countryEdit').val(response.country);
																												$('#zipcodeEdit').val(response.zip_code);
																								}
																				}
																})
																$('#showdepartmentEdit').css("display", "block");
												});
												$('#cancel').on('click', function() {
																$('#showdepartment').css("display", "none");
												});
												$(document).ready(function() {
																$("#idForm").on("submit", function(e) {
																				e.preventDefault();
																				var form = $(this);
																				var actionUrl = form.attr('action');
																				var location_name = $('#location_name').val();
																				var selectDepartment = $('#selectDepartment').val();
																				var note = $('#note_create').val();

																				var csrfToken = $('meta[name="csrf-token"]').attr('content');

																				var data = {
																								department_model_id: selectDepartment,
																								location_name: location_name,
																								note: note,
																								_token: csrfToken
																				};

																				$.ajax({
																								type: "POST",
																								url: actionUrl,
																								data: data,
																								success: function(response) {
																												if (response.location_name_error || response.department_error) {
																																$('#error_location').text(response.location_name_error);
																																$('#error_selectDepartment').text(response.department_error);

																																setTimeout(function() {
																																				$('#alert-success').css('display', 'none');
																																				$('#error_selectDepartment').text('');
																																				$('#error_location').text('');
																																}, 3000);
																												} else {
																																var dataTable = $('#datatable').DataTable();

																																var url = '{{ route("locations.destroy", ":id") }}'
																																				.replace(':id',
																																								response.id);
																																var newRow = '<tr>' +
																																				'<td id="id">' + response.id + '</td>' +
																																				'<td>' +
																																				'<p id="name">' + response.location_name + '</p>' +
																																				'Accounting Department' +
																																				'</td>' +
																																				'<td id="department" style="width: 500px;word-wrap:break-word;">' +
																																				response.department.department_name + ' ,' +
																																				response.department.floor + ' ,' +
																																				response.department.unit + ' ,' +
																																				response.department.building + ' ,' +
																																				response.department.street_address + ' ,' +
																																				response.department.city_name + ' ,' +
																																				response.department.state_name + ' ,' +
																																				response.department.country + ' ,' +
																																				response.department.zip_code +
																																				'</td>' +
																																				'<td>' +
																																				'<p id="note">' + response.note + '</p>' +
																																				'</td>' +
																																				'<td style="display: flex;flex-wrap: wrap;justify-content: center;gap: 3px;">' +
																																				'<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#custom-width-modal"' +
																																				'onclick="editRow(this)">Edit</button>' +
																																				'<button class="btn btn-info waves-effect waves-light copy-button" type="button" style="width: 70px;"' +
																																				'onclick="copyRow(this)">Copy</button>' +
																																				'<form class="formDelete" action="' + url +
																																				'" method="POST">' +
																																				'@csrf' +
																																				'@method("DELETE")' +
																																				'<button class="btn btn-danger btn-bordered waves-effect waves-light" type="submit">Delete</button>' +
																																				'</form>' +
																																				'</td>' +
																																				'</tr>';
																																$("#TableBody").prepend(newRow);
																																$('.formDelete').on('submit', function(e) {
																																				e.preventDefault();
																																				var form = $(this);
																																				var actionUrl = form.attr('action');
																																				var formData = form.serialize();

																																				$.ajax({
																																								type: "DELETE",
																																								url: actionUrl,
																																								data: formData,
																																								success: function(response) {
																																												var row = form.closest("tr");
																																												row.remove();
																																								}
																																				});
																																});
																																$('#alert-success').css('display', 'block');
																																$('#mess').text('Successfull!');
																																setTimeout(function() {
																																				$('#alert-success').css('display', 'none');
																																}, 3000);
																												}
																								},
																				});
																});
												});
												$(document).ready(function() {
																$("#idFormEdit").on("submit", function(e) {
																				e.preventDefault();
																				var form = $(this);
																				var actionUrl = form.attr('action');
																				var location_name = $('#location_name_edit').val();
																				var selectDepartment = $('#selectDepartmentEdit').val();
																				var id = $('#idedit').val();
																				var note = $('#note_edit').val();
																				var csrfToken = $('meta[name="csrf-token"]').attr('content');

																				var data = {
																								department_model_id: selectDepartment,
																								location_name: location_name,
																								note: note,
																								id: id,
																								_token: csrfToken
																				};

																				$.ajax({
																								type: "PUT",
																								url: actionUrl,
																								data: data,
																								success: function(response) {

																												if (response.location_name || response.department_model_id) {

																																$('#error_locationEdit').text(response.location_name);

																																$('#error_selectDepartmentEdit').text(response
																																				.department_model_id);

																																setTimeout(function() {
																																				$('#alert-success-edit').css('display',
																																								'none');
																																				$('#error_selectDepartmentEdit').text('');
																																				$('#error_locationEdit').text('');
																																}, 3000);
																												} else {
																																location.reload();
																												}
																								},
																				});
																});
												});

												function editRow(button) {
																var id = button.closest('tr').querySelector('#id').textContent;
																var name = button.closest('tr').querySelector('#name').textContent;
																var department = button.closest('tr').querySelector('#department').textContent;
																var note = button.closest('tr').querySelector('#note').textContent;
																document.getElementById('idedit').value = id;
																document.getElementById('location_name_edit').value = name;
																document.getElementById('note_edit').value = note;
												}

												function copyRow(button) {
																var id = button.closest('tr').querySelector('#id').textContent;
																var name = button.closest('tr').querySelector('#name').textContent;
																var department = button.closest('tr').querySelector('#department').textContent;
																var note = button.closest('tr').querySelector('#note').textContent;

																var dataToCopy = id + ' ' + name + ' ' + department + ' ' + note;

																var copyTextarea = document.createElement("textarea");
																copyTextarea.value = dataToCopy;
																document.body.appendChild(copyTextarea);

																copyTextarea.select();

																document.execCommand('copy');

																document.body.removeChild(copyTextarea);
												}
												$(document).ready(function() {
																$('.formDelete').on('submit', function(e) {
																				e.preventDefault();
																				var form = $(this);
																				var actionUrl = form.attr('action');
																				var formData = form.serialize();

																				$.ajax({
																								type: "DELETE",
																								url: actionUrl,
																								data: formData,
																								success: function(response) {
																												var row = form.closest("tr");
																												row.remove();
																								}
																				});
																});
												});
												var dataTable = $('#datatable').DataTable();
												dataTable.on('draw', function() {
																$(document).ready(function() {
																				$('.formDelete').on('submit', function(e) {
																								e.preventDefault();
																								var form = $(this);
																								var actionUrl = form.attr('action');
																								var formData = form.serialize();

																								$.ajax({
																												type: "DELETE",
																												url: actionUrl,
																												data: formData,
																												success: function(response) {
																																var row = form.closest("tr");
																																row.remove();
																												}
																								});
																				});
																});
												});
								</script>
				@endpush
@endonce
