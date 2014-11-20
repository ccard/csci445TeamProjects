@extends('masterform')

@section('subHeading')
	Manage Projects Under Contruction

@stop

@section('optionGroup')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">Back to Administration pane</a>
@stop

@section('backButton')
	<a class="btn btn-link" href="{{ url('home') }}">&larr;Home</a>
@stop

@section('content')

	<div class="showList">
	<!--	'title','company','min','max' -->
		<strong> Project Title  Company  Min students  Max students </strong>
		@foreach ($projectInfo as $info)
			<div class="showList">
				{{$info->title}} <strong>| {{$info->company}}  </strong>| {{$info->min}} |  {{$info->max}}
				</a>
			</div>
		@endforeach
	</div>
	

@stop
