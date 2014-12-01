@extends('master')

@section('backButton')
	<a class="btn btn-link" href="{{ url('home') }}">&larr;Home</a>
@stop

@section('subHeading')
	Edit Team
@stop

@section('content')
<!-- projectteam is of the form ('projid'=>id, 'projname'=>'projname', 'users'=>array('userid'=>array('name'=>'name', 'email'=>'email')...)) -->
	<div class="content" style="margin-left: 10px">
		<div class="page-header">
			<h2>{{ $projectteam['projname'] }} <a id="editname" class="btn btn-link pull-right" data-toggle="modal" data-target="#modaladminadduser">+Add member</a></h2>
		</div>
		<div class="content" style="margin-left: 10px">
			@foreach($projectteam['users'] as $key => $value)
				<div class="form-group">
					<a class=" btn-link" href="{{ url('users/'.$key.'/info') }}" style="color: #000">{{ $value['name'] }}</a> - <a class="btn-link" href="mailto:{{ $value['email']}}?Subject=CSCI%20307" target="_top">{{ $value['email']}}</a>
						<div class="pull-right">
							{{ Form::open(array('method'=>'delete', 'url'=>'home/editteam/'.$projectteam['projid']))}}
							{{ Form::hidden('userid',$key) }}
							{{Form::submit('Remove',array("class"=>" btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to remove this user?')){return false;};")) }} 
							{{ Form::close() }}
						</div>
						
				</div>
			@endforeach
		</div>
		<div id="adminaddteam">
			{{ $adminaddteam }}
		</div>
	</div>
@stop

@section('nonauthcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop