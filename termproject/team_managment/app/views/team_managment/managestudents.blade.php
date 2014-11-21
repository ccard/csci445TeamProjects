@extends('master')

@section('subHeading')
	Manage Students
@stop

@section('backButton')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">&larr;Administration pane</a>
@stop

@section('content')
	<div class="content" style="margin-left: 10px">
		@foreach($userInfo as $user)
			<div class="page-header">
				<h2>
					<a class="tip" data-toggle="tooltip" data-placement="bottom" title="Get more detailed user info" style="color: inherit" href="{{ url('users/'.$user->id.'/info') }}"> {{ $user->lastname.', '.$user->firstname }} </a>
					<div class="pull-right">
						<div class="pull-left">
							{{ Form::open(array('method'=>'put','action'=>array('GenerateTeams@resetPassword'))) }}
							{{ Form::hidden('userid',$user->id) }}
							{{ Form::submit('Reset Password',array("class"=>"btn btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to reset the password?')){return false;};")) }}
							{{ Form::close() }}
						</div>
						<div class="pull-right">
							{{ Form::open(array('method'=>'delete','action'=>array('GenerateTeams@deleteUser'))) }}
							{{ Form::hidden('userid',$user->id) }}
							{{ Form::submit('Remove',array("class"=>"btn btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to delete this user?')){return false;};")) }}
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
	</div>
@stop

@section('nonauthformcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop