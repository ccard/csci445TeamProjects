@extends('master')

@section('subHeading')
	Administration
@stop

@section('optionGroup')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">Administration pane</a>
@stop

@section('content')
	<div class="content" style="margin-left: 20px">
	@if ($users == 0)
		<div class="alert alert-warning">
			Please seed the database with users <!--TODO create ability to upload new users -->
		</div>
	@else
		@if ($projects == 0)
		<div class="alert alert-warning">
			Please seed the database with projects <!--TODO create ability to upload new users -->
		</div>
		@elseif (count($projectteams) == 0)
			<div class="alert alert-warning">
				{{ Form::open(array('action'=>'GenerateTeams@generateTeams')) }}
				Please generate tables by clicking {{ Form::submit('here',array("class"=>"btn-link")) }}
				{{ Form::close() }}
			</div>
		@else
			<a class="btn btn-link" href="mailto:{{ $emails }}?Subject=CSCI%20307" target="_top">Email all users</a>
			<!-- Project teams is in the following format array('projectid'=>array('projname'=>'projname', 'members'=>array('email'=>'username')))-->
			@foreach ($projectteams as $key => $value)
				<div class="content" style="margin-left: 10px">
					<div class="page-header">
						<h2>
						 {{ $value['projname'] }} <a class="btn btn-link pull-right" href="{{ url('home/editteam/'.$key) }}">edit</a>
						</h2>
					</div>
					<div class="content" style="margin-left: 10px">
						@foreach($value['members'] as $key => $value)
							<div class="teammembers">
								{{ $value }} - <a class="btn btn-link" href="mailto:{{$key}}?Subject=Csci%20307"> {{ $key }} </a>
							</div>
						@endforeach
					</div>
				</div>
			@endforeach
			@endif
		@endif
	</div>
@stop

@section('nonauthcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn-link">login</a>
	</div>
@stop