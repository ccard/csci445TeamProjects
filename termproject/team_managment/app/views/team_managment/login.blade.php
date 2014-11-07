@extends('masterform')
@section('subHeading')
Welcome!
@stop
@section('formcontent')
	<div class="alert alert-success">
		You are already logged in please go to your <a href="{{url('/')}}" class="btn btn-link">home</a> page!
	</div>
@stop
@section('nonauthformcontent')
	{{ Form::open() }}
	<div class="form-group">
		{{Form::label('User name:')}} {{ Form::text('username', Input::old('username'), array('placeholder'=>'jdoe@mymail.mines.edu')) }}
	</div>
	<div class="form-group">
		{{ Form::label('Password:') }} {{ Form::password('password', array('placeholder' => 'placetext')) }}
	</div>
	{{ Form::submit("Login" , array("class"=>"btn btn-primary")) }}
	{{ Form::close() }}
@stop