@extends('masterform')

@section('formcontent')
	{{ Form::model(Auth::user(), array('method'=>$method, 'url'=>'firstlogin'))}}
	<div class="content">
		<div class="page-header">
			<h2>General Info</h2>
		</div>
		<div class="content">
			<div class="form-group">
				{{ Form::label('Major') }} {{ Form::text('majortext', array('placeholder'=>'i.e. Computer Science')) }}
			</div>
			<div class="form-group">
				{{ Form::label('Minor/ASI') }} {{ Form::text('minortext', array('placeholder'=>'i.e. Mathmatics')) }}
			</div>
			<div class="form-group">
				{{ Form::label('Relevent goals/experience') }} {{ Form::text('expirencetext', array('placeholder'=>'i.e. Programed alot')) }}
			</div>
		</div>
	</div>
	<div class="content">
		<div class="page-header">
			<h2>Project Preferences</h2>
		</div>
		<div class="content">
			<div class="form-group">
				{{ Form::label('1st choice') }} {{ Form::select('1st_proj_id', $projoptions) }}
			</div>
			<div class="form-group">
				{{ Form::label('Minor/ASI') }} {{ Form::text('minortext', array('placeholder'=>'i.e. Mathmatics')) }}
			</div>
			<div class="form-group">
				{{ Form::label('Relevent goals/experience') }} {{ Form::text('expirencetext', array('placeholder'=>'i.e. Programed alot')) }}
			</div>
		</div>
	</div>
@stop

@section('nonauthformcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
	</div>
@stop