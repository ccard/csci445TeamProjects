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
			<div class="form-horizontal">
				<div class="page-header">
					<h2>Personal info</h2>
				</div>
				<div class="form-group">
					{{ Form::label('Name',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
					  {{ Form::text('name',$user->firstname.' - '.$user->lastname,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
					    <a id="editname" class="btn-link pull-right" data-toggle="modal" data-target="#modalnamechange">Edit Name</a>
					 </div>
				</div>
				<div class="form-group">
					{{ Form::label('Email',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
					 	{{ Form::text('username',$user->username,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled'))}}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Password - </label> <a id="editpass" class="btn-link form-control" data-toggle="modal" data-target="#modalpasschange">Change</a>
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