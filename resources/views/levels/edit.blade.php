@extends('layout')

@section('content')

				
	<h1>Nivel: {{ $level->title }}</h1>
	<hr>
	
	{{-- Binding a form to an Eloquent model to populate data in inputs dinamicly --}}
	{{-- form::model(model_class_name) --}}
	{!! Form::model( $level, ['method' => 'PATCH', 'action' => ['LevelsController@update', $level->id]]) !!}
		

		@include('partials.formLevel', ['submitBtnText' => 'Update Level', 'currentLevelIndex' => null])


	{!! Form::close() !!}
	
	@include('errors.list')	

@stop;