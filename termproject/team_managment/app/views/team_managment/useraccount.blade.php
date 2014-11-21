@extends('masterform')
@section('subHeading')
	@if(empty($method))
	Your account
	@else
	User info
	@endif
@stop
@section('backButton')
	@if(!empty($method))
		<a class="btn btn-link" href="{{ URL::previous() }}">&larr;Back</a>
	@else
		<a class="btn btn-link" href="{{ url('home') }}">&larr;Home</a>
	@endif
@stop
@section('formcontent')
	@if(empty($user))
	<div class="alert alert-warning">
		No user information :(
	</div>
	@elseif(!empty($method))
		<div class="content" style="margin-left: 10px">
			<div class="form-horizontal">
				<div class="page-header">
					<h2>Personal info</h2>
				</div>
				<div class="form-group">
					{{ Form::label('Name',null,array("class"=>"control-label col-sm-2"))}}
					<div class="col-sm-10">
						{{ Form::text('name',$user->firstname.' - '.$user->lastname,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Email',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
						{{ Form::text('username',$user->username,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('Major',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
						 	{{ Form::text('majortext',$user->majortext,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
						</div>
				</div>
				<div class="form-group">
					 	{{ Form::label('Minor/ASI',null,array("class"=>"control-label col-sm-2")) }}
						<div class="col-sm-10">
						 	{{ Form::text('minortext',$user->minortext,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
						</div>
				</div>
				<div class="form-group">
					{{ Form::label('Experience-',null,array("class"=>"control-label col-sm-2"))}}
					<div class="col-sm-10">
						{{ Form::textarea('experiencetext',$user->experience,array("class"=>"form-control",'readonly'=>"readonly",'cols'=>"100",'rows'=>"2",0=>'disabled')) }}
					</div>
				</div>
			</div>
		</div>
		<div class="content" style="margin-left: 10px">
			<div class="content form-horizontal">
				<div class="page-header">
					<h2>Project Preferences</h2>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2">1<sup>st</sup> prefence</label>  
					<div class="col-sm-10">
						@if(is_null($user->projectPreferences))
							<div class="alert alert-warning">
								No project prefences selected
							</div>
						@else
							{{ Form::select('first_project_id', $projoptions,$user->projectPreferences->first_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
						@endif
					</div>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2">2<sup>nd</sup> prefence</label>  
						<div class="col-sm-10">
							@if(is_null($user->projectPreferences))
								<div class="alert alert-warning">
									No project prefences selected
								</div>
							@else
								{{ Form::select('second_project_id', $projoptions,$user->projectPreferences->second_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
							@endif
						</div>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2"> 3<sup>rd</sup> preference </label>
					<div class="col-sm-10">
						@if(is_null($user->projectPreferences))
							<div class="alert alert-warning">
								No project prefences selected
							</div>
						@else
							{{ Form::select('third_project_id', $projoptions,$user->projectPreferences->third_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="content" style="margin-left: 10px">
			<div class="content">
				<div class="page-header">
					<h2>Partner Preferences</h2>
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
							{{ Form::radio('pref_part_or_proj','1',($user->pref_part_or_proj == 1 ? true : null),array(0=>'disabled'))}}
							{{ Form::label('partner','Prefer Partners',array("class"=>"control-label", "style"=>"margin-right: 15px")) }}
						</div>
						<div class="form-group checkbox-inline">
							{{ Form::radio('pref_part_or_proj', '0', ($user->pref_part_or_proj == 0 ? true : null),array(0=>'disabled'))}}
							{{ Form::label('project','Prefer Project',array("class"=>"control-label")) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="content" style="margin-left: 10px">
			<div class="form-horizontal">
				<div class="page-header">
					<h2>Personal info</h2>
				</div>
				<div class="form-group">
					{{ Form::label('Name',null,array("class"=>"control-label col-sm-2"))}}
					<div class="col-sm-10">
						{{ Form::text('name',$user->firstname.' - '.$user->lastname,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}  
						<a id="editname" class="btn-link pull-right" data-toggle="modal" data-target="#modalnamechange">Edit Name</a>
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Email',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
						{{ Form::text('username',$user->username,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('Major',null,array("class"=>"control-label col-sm-2")) }}
					<div class="col-sm-10">
						 	{{ Form::text('majortext',$user->majortext,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
						</div>
				</div>
				<div class="form-group">
					 	{{ Form::label('Minor/ASI',null,array("class"=>"control-label col-sm-2")) }}
						<div class="col-sm-10">
						 	{{ Form::text('minortext',$user->minortext,array("class"=>"form-control",'readonly'=>"readonly",0=>'disabled')) }}
						 	<a id="editdeg" class="btn-link pull-right" data-toggle="modal" data-target="#modaldegchange">Edit Major/Minor</a>
						</div>
				</div>
				<div class="form-group">
					{{ Form::label('Experience-',null,array("class"=>"control-label col-sm-2"))}}
					<div class="col-sm-10">
						{{ Form::textarea('experiencetext',$user->experience,array("class"=>"form-control",'readonly'=>"readonly",'cols'=>"100",'rows'=>"2",0=>'disabled')) }}
						 <a id="editexperience" class="btn-link pull-right" data-toggle="modal" data-target="#modalexpchange">Edit Expirence</a>
					</div>
				</div>
				<div class="form-group" style="margin-left: 10px">
					<label class="control-label col-sm-2">Password -
					<a id="editpass" class="btn-link" data-toggle="modal" data-target="#modalpasschange">Change</a></label>
				</div>
			</div>
		</div>
		<div class="content" style="margin-left: 10px">
			<div class="content form-horizontal">
				<div class="page-header">
					<h2>Project Preferences <a id="editexperience" class="btn btn-link pull-right" data-toggle="modal" data-target="#modalprojchange">Edit Project Prefereces</a></h2>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2">1<sup>st</sup> prefence</label>  
					<div class="col-sm-10">
							{{ Form::select('first_project_id', $projoptions,$user->projectPreferences->first_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
					</div>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2">2<sup>nd</sup> prefence</label>  
						<div class="col-sm-10">
							{{ Form::select('second_project_id', $projoptions,$user->projectPreferences->second_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
						</div>
				</div>
				<div class="form-group">
					<label type="label" class="control-label col-sm-2"> 3<sup>rd</sup> preference </label>
					<div class="col-sm-10">
						{{ Form::select('third_project_id', $projoptions,$user->projectPreferences->third_project_id,array("class"=>"form-control tip", 'data-toggle'=>'tooltip', 'data-placement'=>'bottom','title'=>'This is a required field',0=>'required','autocomplete'=>"off",1=>'disabled')) }}
					</div>
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
							{{ Form::radio('pref_part_or_proj','1',($user->pref_part_or_proj == 1 ? true : null),array(0=>'disabled'))}}
							{{ Form::label('partner','Prefer Partners',array("class"=>"control-label", "style"=>"margin-right: 15px")) }}
						</div>
						<div class="form-group checkbox-inline">
							{{ Form::radio('pref_part_or_proj', '0', ($user->pref_part_or_proj == 0 ? true : null),array(0=>'disabled'))}}
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
	@endif
@stop
@section('nonauthformcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop
@section('script')
@stop