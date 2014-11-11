@extends('masterform')
@section('subHeading')
Please fill out your information
@stop
@section('formcontent')
	{{ Form::model($user, array('method'=>$method, 'url'=>'firstlogin/'.(Auth::check() ? $user->id : -1))) }}
	<div class="content" style="margin-left: 10px">
		<div class="page-header">
			<h2>General Info</h2>
		</div>
		<div class="content form-horizontal">
			<div class="form-group">
				{{ Form::label('Major',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::text('majortext',null, array('placeholder'=>'i.e. Computer Science', "class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Minor/ASI',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::text('minortext',null, array('placeholder'=>'i.e. Mathmatics',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>	'bottom','title'=>'This is a required field', 0=>'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Relevent Goals/Experience',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::textarea('expirencetext', null, array('placeholder'=>'i.e. Programed alot',"class"=>"form-control", "rows"=>"3")) }}
				</div>
			</div>
		</div>
	</div>
	<div class="content" style="margin-left: 10px">
		<div class="page-header">
			<h2>Project Preferences</h2>
		</div>
		<div class="content form-horizontal">
			<div class="form-group">
				{{ Form::label('1st choice',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::select('first_proj_id', $projoptions,null,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('2nd choice',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::select('second_proj_id', $projoptions,null,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('3rd choice',null,array("class"=>"col-sm-2 control-label")) }}
				<div class="col-sm-10">
					{{ Form::select('third_proj_id', $projoptions,null,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required')) }}
				</div>
			</div>
		</div>
	</div>
	<div class="content" style="margin-left: 10px">
		<div class="page-header">
			<h2>Team Preferences</h2>
		</div>
		<div class="content form-horizontal">
			<div class="row">
				<div class="form-group col-lg-6">
					{{ Form::label('Prefered Partners',null,array("class"=>"col-lg-2 control-label")) }}
					<div class="col-lg-10">
						{{ Form::select('pref_partner[]', $partneroptions,null,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person')) }}
					</div>
				</div>
				<div class="form-group col-lg-6">
					{{ Form::label('Dont want to work with',null,array("class"=>"col-lg-2 control-label")) }}
					<div class="col-lg-10">
						{{ Form::select('no_pref_partner[]', $partneroptions,null,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person')) }}
					</div>
				</div>
			</div>
			<div class="text-center row">
				<div class="form-group checkbox-inline">
					{{ Form::radio('pref_part_or_proj','true')}}
					{{ Form::label('partner','Prefer Partners',array("class"=>"control-label", "style"=>"margin-right: 15px")) }}
				</div>
				<div class="form-group checkbox-inline">
					{{ Form::radio('pref_part_or_proj', 'false', true)}}
					{{ Form::label('project','Prefer Project',array("class"=>"control-label")) }}
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		{{ Form::submit("Save", array("class"=>"btn btn-primary","style"=>"margin-top: 20px")) }}
	</div>
	{{ Form::close() }}
@stop
@section('nonauthformcontent')
<div class="alert alert-warning">
	You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
</div>
@stop