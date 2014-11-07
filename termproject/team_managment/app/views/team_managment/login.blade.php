@extends('masterform')
@section('subHeading')
Welcome
@stop
@section('formcontent')
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