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
		You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
	</div>
	<div class="content" style="margin-left: 10px">
		<div class="content">
			<div class="page-header">
				<h2>Personal info</h2>
			</div>
			<div class="content" style="margin-left: 10px">
				<span>Name:  {{ 'first' }} - {{ 'last' }}  -<a id="editname" class="btn btn-link" data-toggle="modal" data-target="#modalnamechange">Edit Name</a> </span>
				<span class="text-right" style="margin-left: 30px"> Email - {{ 'user email'}}</span>
			</div>
			<div class="content" style="margin-left: 10px">
				<span> Major: {{ 'user major' }} <br> Minor/ASI: {{ 'user minor' }} - <a id="editdeg" class="btn btn-link" data-toggle="modal" data-target="#modaldegchange">Edit Major/Minor</a></span>
			</div>
			<div class="content" style="margin-left: 10px; margin-top: 20px;">
				<span> Experience- <textarea rows="2" cols="100"> {{ 'user experience' }} </textarea> - <a id="editexperience" class="btn btn-link" data-toggle="modal" data-target="#modalexpchange">Edit Expirence</a></span>
			</div>
			<div class="content" style="margin-left: 10px">
				<span>Password -<a id="editpass" class="btn btn-link" data-toggle="modal" data-target="#modalpasschange">Change</a> </span>
			</div>
		</div>
	</div>
	<div class="content" style="margin-left: 10px">
		<div class="content">
			<div class="page-header">
				<h2>Project Preferences <a id="editexperience" class="btn btn-link pull-right" data-toggle="modal" data-target="#modalprojchange">Edit Project Prefereces</a></h2>
			</div>
			<div class="content" style="margin-left: 10px">
				<span>1<sup>st</sup> prefence:  {{ 'firstPreference' }} </span>
			</div>
			<div class="content" style="margin-left: 10px">
				<span> 2<sup>nd</sup> preference: {{ 'second pref' }}</span>
			</div>
			<div class="content" style="margin-left: 10px">
				<span> 3<sup>rd</sup> preference: {{ 'third pref' }}</span>
			</div>
		</div>
	</div>
	<div class="content" style="margin-left: 10px">
		<div class="content">
			<div class="page-header">
				<h2>Partner Preferences <a id="editexperience" class="btn btn-link pull-right" data-toggle="modal" data-target="#modalpartchange">Edit Partner Preferences</a></h2>
			</div>
			<div class="content form-horizontal">
				<div class="row">
					<div class="form-group col-lg-6">
						{{ Form::label('Prefered Partners',null,array("class"=>"col-lg-2 control-label")) }}
						<div class="col-lg-10">
							{{ Form::select('pref_partner[]', $partneroptions,$perferedchoice,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person','readonly'=>'readonly',0=>'disabled')) }}
						</div>
					</div>
					<div class="form-group col-lg-6">
						{{ Form::label('Dont want to work with',null,array("class"=>"col-lg-2 control-label")) }}
						<div class="col-lg-10">
							{{ Form::select('no_pref_partner[]', $partneroptions,$avoidchoice,array('multiple'=>'multiple',"class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'Hold ctrl to select more than one person','readonly'=>'readonly', 0=>'disabled')) }}
						</div>
					</div>
				</div>
				<div class="text-center row">
					<div class="form-group checkbox-inline">
						{{ Form::radio('pref_part_or_proj','true',null,array(0=>'disabled'))}}
						{{ Form::label('partner','Prefer Partners',array("class"=>"control-label", "style"=>"margin-right: 15px")) }}
					</div>
					<div class="form-group checkbox-inline">
						{{ Form::radio('pref_part_or_proj', 'false', true,array(0=>'disabled'))}}
						{{ Form::label('project','Prefer Project',array("class"=>"control-label")) }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="namechange">
		{{ $namechange }}
	</div>
	<div id="degchange">
		{{ $degchange }}
	</div>
	<div id="expchange">
		{{ $expchange }}
	</div>
	<div id="passchange" >
		{{ $passchange }}
	</div>
	<div id="projprefchange">
		{{ $projprefchange }}
	</div>
	<div id="partprefchange">
		{{ $partprefchange }}
	</div>
@stop
@section('script')
@stop