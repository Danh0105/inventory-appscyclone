@extends('Admin.Home.Layout.app')
@section('header')
    <link href="/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link type="text/css" href="/plugins/multiselect/css/multi-select.css" rel="stylesheet" />
    <link type="text/css" href="/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/plugins/switchery/switchery.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Supplier</h4>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
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

                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection

@once
    @push('scripts')
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
                    url: '{{ route('locations.show', ['location' => ':selectedValue']) }}'.replace(
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
                    url: '{{ route('locations.show', ['location' => ':selectedValue']) }}'.replace(
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

                                var url = '{{ route('locations.destroy', ':id') }}'
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
                                    '@method('DELETE')' +
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
