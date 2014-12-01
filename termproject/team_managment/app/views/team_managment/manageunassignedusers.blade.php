@extends('master')

@section('subHeading')
	Manage Unassigned Students
@stop

@section('backButton')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">&larr;Administration pane</a>
@stop

@section('content')
	<div class="content" style="margin-left: 10px">
		@if(count($userInfo) == 0)
			<div class="alert alert-warning">
				There are no unassigned students!
			</div>
		@else
			@foreach($userInfo as $user)
				<div class="page-header">
					<h2>
						<a class="tip" data-toggle="tooltip" data-placement="bottom" title="Get more detailed user info" style="color: inherit" href="{{ url('users/'.$user->id.'/info') }}"> {{ $user->lastname.', '.$user->firstname }} </a>
						<div class="pull-right">
							<div class="pull-left">
								{{ Form::open(array('method'=>'put','url'=>'home/accountinfo/managestudents/resetpass')) }}
								{{ Form::hidden('userid',$user->id) }}
								{{ Form::submit('Reset Password',array("class"=>"btn btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to reset the password?')){return false;};")) }}
								{{ Form::close() }}
							</div>
							<div class="pull-right">
								{{ Form::open(array('method'=>'delete','url'=>'home/accountinfo/managestudents/deleteuser')) }}
								{{ Form::hidden('userid',$user->id) }}
								{{ Form::submit('-Remove',array("class"=>"btn btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to delete this user?')){return false;};")) }}
								{{ Form::close() }}
							</div>
						</div>
					</h2>
				</div>
				<div class="content" style="margin-left: 10px">
					<div class="content">
						Email&nbsp;-&nbsp;<a class="btn-link" href="mailto:{{ $user->username }}?Subject=CSCI%20307">{{ $user->username }}</a>
					</div>
					<div class="content">
						Major&nbsp;-&nbsp; {{ $user->majortext }}
					</div>
					<div class="content">
						Minor/ASI&nbsp;-&nbsp; {{ $user->minortext }}
					</div>
				</div>
			@endforeach
		@endif
	</div>
	<div class="content" style="margin-left: 10px">
		@if(count($no_members) == 0)
			<div class="alert alert-warning">
				There are no teams with out members!
			</div>
		@else
			<div class="page-header">
				<h2> Projects with no members</h2>
			</div>
			@foreach($no_members as $project)
				<div class="page-header">
					<h3>
						{{ $project->title }}
					</h3>
				</div>
				<div class="content" style="margin-left: 10px">
					<div class="content">
						Company&nbsp;-&nbsp;{{$project->company}}
					</div>
					@if(count($userInfo) != 0)
						<div class="form-horizontal">
						<div class="form-group">
							{{ Form::open(array('method'=>'put','url'=>"home/accountinfo/adminaddteam")) }}
							{{ Form::hidden('projid',$project->id) }}
							{{ Form::label('Assign Member',null,array("class"=>"col-sm-3 control-label")) }}
							<div class="col-sm-6">
								{{ Form::select('user_id', $memberoptions,null,array("class"=>"form-control",'autocomplete'=>"off")) }}
							</div>
							{{ Form::submit('+Add', array("class"=>"btn btn-link"))}}
							{{ Form::close() }}
						</div>
					</div>
					@endif
				</div>
			@endforeach
		@endif
	</div>
@stop

@section('nonauthcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop