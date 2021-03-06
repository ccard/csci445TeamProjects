<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CSCI 307</title>
		<link rel="stylesheet" href="{{{ asset('bootstrap.min.css') }}}">
		<script src="{{ asset('jquery-2.1.1.min.js') }}"></script>
		<script src="{{ asset('bootstrap.min.js') }}"></script>

	</head>
	<body>
		<div class="container">
			<div class="page-header">
				@if(Auth::check())
					@yield('backButton')
				@endif
				<h1>CSCI 307 <small> @yield('subHeading') </small>
				<div class="pull-right">
					@if(Auth::check())
					@yield('optionGroup')
					<a class="btn btn-link" href="{{url('logout')}}">Log Out</a>
					@else
					<a class="btn btn-link" href="{{url('login')}}">Log In</a>
					@endif
				</div>
				</h1>
			</div>
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{{ Session::get('message') }}}
			</div>
			@endif
			@if(Session::has('error'))
			<div class="alert alert-warning">
				{{{ Session::get('error') }}}
			</div>
			@endif
			@if(Auth::check())
				@yield('content')
				<script type="text/javascript">
				@yield('script')
				</script>
			@else
				@yield('nonauthcontent')
			@endif
		</div>
	</body>
</html>