	@php
		$jobs = [
		    [
		        "link" => route("dashboard.index"),
		        "icon" => "mdi mdi-view-dashboard",
		        "name" => "Dashboard",
		    ],
		    [
		        "link" => route("locations.index"),
		        "icon" => "mdi mdi-city",
		        "name" => "Locations",
		    ],
		    [
		        "link" => route("userrole.index"),
		        "icon" => "mdi mdi-account-multiple",
		        "name" => "User & Roles",
		    ],
		    [
		        "link" => route("asset.index"),
		        "icon" => " mdi mdi-cellphone-link",
		        "name" => "Asset",
		    ],
		];
	@endphp
	@each("Admin.Home.Components.Sidebar.Conditional", $jobs, "job")
