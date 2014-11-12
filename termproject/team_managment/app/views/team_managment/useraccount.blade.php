@extends('masterform')

@section('subHeading')
	Your account
@stop

@section('backButton')
	<a class="btn btn-link" href="{{ url('home') }}">&larr;Home</a>
@stop

@section('formcontent')
	@if(empty($user))
		<div class="alert alert-warning">
		No user information :(
		</div>
	@else
		<div class="content" style="margin-left: 10px">
			<div class="content">
				<div class="page-header">
					<h2>Personal info</h2>
				</div>
				
			</div>
		</div>
	@endif
@stop

@section('nonauthformcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
	</div>
@stop