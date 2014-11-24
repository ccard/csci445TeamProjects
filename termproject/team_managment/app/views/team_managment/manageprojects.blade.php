@extends('master')

@section('subHeading')
	Manage Projects
@stop

@section('backButton')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">&larr;Administration pane</a>
@stop

@section('content')
	<div class="content" style="margin-left: 10px">
		<div class="content">
			<a id="adproj" class="btn-link form-control" data-toggle="modal" data-target="#modaladdproj">+Add Project</a>
		</div>

		@foreach($projectInfo as $project)
			<div class="page-header">
				<h2>
					{{ $project->title }}
					<div class="pull-right">
							{{ Form::open(array('method'=>'delete','action'=>array('GenerateTeams@deleteProject'))) }}
							{{ Form::hidden('projid',$project->id) }}
							{{ Form::submit('-Remove',array("class"=>"btn btn-link","style"=>"color: #FF0000","onclick"=>"if(!confirm('Are you sure you want to delete this project?')){return false;};")) }}
							{{ Form::close() }}
					</div>
				</h2>
			</div>
			<div class="content" style="margin-left: 10px">
				<div class="content">
					Company: {{ $project->company }}
				</div>
			</div>
		@endforeach
	</div>

	<div class="addproject">
		{{ $addproject }}
	</div>
@stop

@section('nonauthcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop