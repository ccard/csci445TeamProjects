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

	@endif
@stop

@section('nonauthformcontent')
	<div class="alert alert-warning">
		{{ 5+1 }} You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
	</div>
	<div class="content" style="margin-left: 10px">
			<div class="content">
				<div class="page-header">
					<h2>Personal info</h2>
				</div>
				<div class="content" stlye="margin-left: 10px">
					password - <button type="button" id="editpass" class="btn btn-link" data-toggle="modal" data-target="#modalpasschange">Edit</button>
				</div>
			</div>
		</div>
		<div id="passchange" >
			{{ $passchange }}
		</div>
@stop

@section('script')

@stop