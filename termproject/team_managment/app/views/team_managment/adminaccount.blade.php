@extends('masterform')

@section('subHeading')
	Admin account info
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
				<div class="content" style="margin-left: 10px">
					<span>Name:  {{ $user->firstname }} - {{ $user->lastname }}  -<a id="editname" class="btn-link" data-toggle="modal" data-target="#modalnamechange">Edit Name</a> </span>
					<span class="text-right" style="margin-left: 30px"> Email - {{ $user->username}}</span>
				</div>
				<div class="content" style="margin-left: 10px">
					<span>Password -<a id="editpass" class="btn-link" data-toggle="modal" data-target="#modalpasschange">Change</a> </span>
				</div>
			</div>
			<div id="namechange">
				{{ $namechange }}
			</div>
			<div id="passchange" >
				{{ $passchange }}
			</div>
		</div>
		<div class="content" style="margin-left: 10px">
			<div class="page-header">
				<h2>Admin Controls</h2>
			</div>
			<div class="content" style="margin-left: 10px">
				<a class="btn btn-link" href="{{ url('home/accountinfo/managestudents') }}">Manage Students</a>
				<a class="btn btn-link" href="{{ url('home/accountinfo/manageprojects') }}">Manage Projects</a>
			</div>
		</div>
	@endif
@stop

@section('nonauthformcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop