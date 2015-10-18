@extends('layout')

@section('content')


	<h1>Nuevo Nivel:</h1>
	<h3>Nivel # {{ $currentLevelIndex }}</h3>
	<hr>

	{{-- ['action' => 'LevelsController@store']	will find the controller and use the route of it   --}}

	{!! Form::open(['action' => 'LevelsController@store']) !!}
				

		@include('partials.formLevel', ['submitBtnText' => 'Create Level', 'currentLevelIndex' => $currentLevelIndex])

	{!! Form::close() !!}

	@include('errors.list')	

@stop