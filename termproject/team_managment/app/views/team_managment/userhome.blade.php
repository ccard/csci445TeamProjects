@extends('master')

@section('subHeading')
	Your project information
@stop
@section('optionGroup')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">Account Info </a>
@stop

@section('content')
	@if (count($project) > 0)
		<div class="content" style="margin-left: 20px">
			<div class="page-header">
				<h2>{{$project['name']}}</h2>
			</div>
			<div class="content" style="margin-left: 10px">
				@foreach ($project['members'] as $key => $value)
					<div class="partners">
						{{$value}} - <a class="btn btn-link" href="mailto:{{$key}}?Subject=Csci%20307" target="_top">{{$key}}</a>
					</div>
				@endforeach
			</div>
		</div>
	@else
		<div class="alert alert-warning">
				You are not currently assigned to a project please check back later!
		</div>
	@endif
@stop

@section('nonauthcontent')
	<div class="alert alert-warning">
		You are not logged in! Please <a href="{{url('/')}}" class="btn btn-link">login</a>
	</div>
@stop