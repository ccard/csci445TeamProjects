@extends('modalmaster')

@section('modalHead')
	Change password
@stop

@section('dialogid')
{{ "modalpasschange" }}
@stop
@section('modalcontent')
	{{ Form::model($user,array('method'=>'put', 'action'=>array('GenerateTeams@changePassword',$user))) }}
	
		<div class="form-group">
			{{ Form::label('Old password',null,array("class"=>"control-label col-sm-2"))}}
			<div class="col-sm-5">
				{{ Form::password('password',array("class"=>"form-control", 0=>'required'))}}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('New password',null,array("class"=>"control-label col-sm-2"))}}
			<div class="col-sm-5">
				{{ Form::password('newpassword',array("class"=>"form-control", 0=>'required'))}}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('Confirm password',null,array("class"=>"control-label col-sm-2"))}}
			<div class="col-sm-5">
				{{ Form::password('confirmpassword',array("class"=>"form-control", 0=>'required')) }}
			</div>
		
	</div>
@stop

@section('modalfoot')
	{{ Form::submit('Save',array("class"=>"btn btn-primary")) }}
	{{ Form::close() }}
@stop