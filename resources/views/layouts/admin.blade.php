<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Page Title Here -->
	{{-- <title> {{ config('app.name', 'Laravel') }}</title> --}}
	<title>@yield('title') || {{ config('app.name', 'Laravel') }}</title>

<!-- FAVICONS ICON -->
	@if ($siteInfo->fav_icon)
	<link rel="shortcut icon" type="image/png" href="{{asset('storage/site/'.$siteInfo->fav_icon)}}" >
	@else
	<link rel="shortcut icon" type="image/png" href="{{asset('assets')}}/images/logo.png" >
	@endif
	<link href="{{asset('assets')}}/vendor/wow-master/css/libs/animate.css" rel="stylesheet">
	@stack('css')
	<!-- Style css -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('assets')}}/css/style.css" rel="stylesheet">

    <style>
        .footer{
            bottom: 0px;
            width: 100%;
			margin-top: 10px;
        }
        .dropdown.bootstrap-select.swal2-select.dropdown.bootstrap-select.swal2-select{
            display: none;
        }
		ul.action_btn{
			float: right;
		}
		ul.action_btn li{
			float: left;
			margin-left: 5px;
		}
		.contacts_icon a{
			font-size: 16px;
			margin: 0px 5px;
			border-radius: 50%;
			padding: 3px 6px;
			background: #7e7e7e;
			color: #ffffff;
		}
    </style>
	
</head>
<body>

    <div id="main-wrapper" class="show">
	
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

		<div class="content-body">
			<div class="container-fluid">
				@yield('content')
			</div>
		</div>

        @include('layouts.partials.footer')
	</div>

	@yield('modal')

    @include('sweetalert::alert')

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets')}}/vendor/global/global.min.js"></script>
	@stack('js')
    <script src="{{asset('assets')}}/js/custom.min.js"></script>
	<script src="{{asset('assets')}}/js/dlabnav-init.js"></script>	
</body>
</html>