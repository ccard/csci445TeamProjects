@extends('master')
@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			@yield('formcontent')
		</div>
	</div>
@stop
@section('nonauthcontent')
	<div class="panel panel-default">
		<div class="panel-body">
			@yield('nonauthformcontent')
		</div>
	</div>
@stop