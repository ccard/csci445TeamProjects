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
	<div class="form-horizontal">
		<div class="col-lg-2"></div>
		<div class="form-group">
			{{Form::label('username','User name:',array("class"=>"col-sm-2 control-label"))}} 
			<div class="col-sm-5">
				{{ Form::text('username', Input::old('username'), array('placeholder'=>'jdoe@mymail.mines.edu',"class"=>"form-control", 0=>'required')) }}
			</div>
		</div>
		<div class="col-lg-2"></div>
		<div class="form-group">
			{{ Form::label('password','Password:',array("class"=>"col-sm-2 control-label")) }} 
			<div class="col-sm-5">
				{{ Form::password('password', array('placeholder' => 'placetext',"class"=>"form-control", 0=>'required')) }}
			</div>
		</div>
		<div class="form-group text-center">
		{{ Form::submit("Login" , array("class"=>"btn btn-primary")) }}
	</div>
		{{ Form::close() }}
	</div>
@stop