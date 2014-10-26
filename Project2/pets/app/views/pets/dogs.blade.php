@extends('master')
@section('header')
	<h1>
	The Awesome Pet Shop <small>By the people who are awesome</small>
	</h1>
@stop
@section('content')
	<div class='page-header'>
		<h3>The list of our awesome dogs.</h3>
	</div>

	<div class='container'>
		@foreach ($dogs as $dog)
			<div class="pet">
				<p>
				<strong> {{{$dog->name}}} </strong> - {{{$dog->age}}}
				</p>
			</div>
		@endforeach
	</div>
	<p>There are currently {{{$dogs->count()}}} dogs on this site. Find a friend!</p>
	<p>Now for some Eloquent ORM practice</p>
	<div class='container'>
		<ui>
			<li><a href="{{url('pets')}}">Show all pets</a></li>
			<li><a href="{{url('pets/type/dog')}}">Show only dogs</a></li>
			<li><a href="{{url('pets/ordered')}}">Order by age</a></li>
		</ui>
	</div>
<!-- </div> -->
@stop
@section('footer')
	<div class='text-center'>
		<p>Stop by today!</p>
	</div>
@stop



