@extends("Admin.Home.Layout.app")
@section("header")
	<link type="text/css" href="/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" />
@endsection
@section("content")
	<div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
				<h4 class="page-title">Dashboard</h4>
				<div class="clearfix"></div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<div class="row" style="display: flex;justify-content: center;">
					<ul class="nav nav-tabs tabs-bordered nav-justified">
						<li class="active">
							<a data-toggle="tab" href="#user1" aria-expanded="true">
								<span class="visible-xs"><i class="fa fa-home"></i></span>
								<span class="hidden-xs">
									<div class="card-box widget-box-two widget-two-success">
										<i class="mdi mdi-account-convert widget-two-icon"></i>
										<div class="wigdet-two-content text-white">
											<p class="text-uppercase font-600 font-secondary text-overflow m-0" title="User Today">User</p>
											<h2 class="text-white"><span data-plugin="counterup">{{ count($users) }}</span> <small><i
														class="mdi mdi-arrow-down text-danger"></i></small></h2>
											<p class="m-0"><b>Last:</b> 1250</p>
										</div>
									</div>
								</span>
							</a>
						</li>
						<li class="">
							<a data-toggle="tab" href="#item1" aria-expanded="false">
								<span class="visible-xs"><i class="fa fa-user"></i></span>
								<span class="hidden-xs">
									<div class="card-box widget-box-two widget-two-info">
										<i class="mdi mdi-chart-areaspline widget-two-icon"></i>
										<div class="wigdet-two-content text-white">
											<p class="text-uppercase font-600 font-secondary text-overflow m-0" title="Statistics">Items</p>
											<h2 class="text-white"><span data-plugin="counterup">{{ count($assets) }}</span> <small><i
														class="mdi mdi-arrow-up text-success"></i></small></h2>
											<p class="m-0"><b>Last:</b> 30.4k</p>
										</div>
									</div>
								</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="user1">
						<div class="row" style="display: flex;justify-content: right;margin:5px;">
							<a class="btn btn-primary waves-effect w-md waves-light" type="button" href="{{ route("userrole.index") }}">View
								More</a>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-color panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Recent Users</h3>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table-hover m-0 table table">
												<thead>
													<tr>
														<th>ID</th>
														<th>NAME</th>
														<th>EMAIL</th>
														<th>PHONE</th>
														<th>LOCATION</th>
														<th>ROLE</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($users as $item)
														<tr>
															<td>{{ $item["id"] }}</td>
															<td>{{ $item["name"] }}</td>
															<td>{{ $item["email"] }}</td>
															<td>{{ $item["phone"] ?? "No Phone" }}</td>
															<td>
																<p>{{ $item["location"]["location_name"] ?? "No Location" }}</p>
																{{ $item["location"]["department"]["department_name"] ?? "No Department" }}
															</td>
															<td> {{ isset($item["role"][0]["name"]) ? $item["role"][0]["name"] : "No Role Assigned" }}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>

										</div> <!-- table-responsive -->
									</div> <!-- end panel body -->
								</div>
								<!-- end panel -->
							</div>
							<!-- end col -->

						</div>
					</div>
					<div class="tab-pane" id="item1">
						<div class="row" style="display: flex;justify-content: right;margin:5px;">
							<a class="btn btn-primary waves-effect w-md waves-light" type="button" href="{{ route("asset.index") }}">View
								More</a>
						</div>
						<div class="panel panel-color panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Recent Users</h3>
							</div>
							<table class="table-hover m-0 table">
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
									</tr>
								</thead>
								<tbody>
									@foreach ($assets as $item)
										<tr>
											<td>{{ $item["id"] }}</td>
											<td>{{ $item["serial"] }}</td>
											<td>{{ $item["asset_name"] }}</td>
											<td>{{ $item["location"]["location_name"] }}</td>
											<td>
												@if ($item["condition"] == 1)
													NON-EXISTENT
												@elseif ($item["condition"] == 2)
													VERRY GOOD
												@elseif ($item["condition"] == 3)
													GOOD
												@elseif ($item["condition"] == 4)
													FAIR
												@elseif ($item["condition"] == 5)
													REQUIRES RENEWAL
												@elseif ($item["condition"] == 6)
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
											<td>{{ $item["price"] }}</td>
											<td>{{ $item["note"] }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
@endsection
