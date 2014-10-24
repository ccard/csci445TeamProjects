<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Pets</title>
		<link rel="stylesheet" href="{{ asset('bootstrap.min.css')}}">
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				@yield('header')
			</div>
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<div class="container">
				@yield('content')
			</div>
			<div class="page-footer">
				@yield('footer')
			</div>
		</div>
	</body>
</html>