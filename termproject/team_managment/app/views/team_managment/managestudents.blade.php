@extends('masterform')

@section('subHeading')
	Manage Students Under Contruction
@stop

@section('backButton')
	<a class="btn btn-link" href="{{url('home/accountinfo')}}">Back to Administration pane</a>
@stop

@section('content')

	<div class="showList">
	<!--	'username','cwid','firstname','lastname','created_at','updated_at','majortext','minortext','experience','project_preferences_id','pref_part_or_proj','project_id' -->
		<strong> First Name  Last Name   Username     Proj pref   PartOrProj    Project ID </strong>
		@foreach ($userInfo as $info)
			<div class="showList">
				{{$info->firstname}} | {{$info->lastname}}  <strong>| {{$info->username}} | </strong> {{$info->project_preferences_id}} | {{$info->pref_part_or_proj}} | {{$info->project_id}}
				</a>
			</div>
		@endforeach
	</div>
	

@stop
