@extends('layout')

@section('content')


	<h1>Nuevo Nivel:</h1>
	<h3>Nivel # {{ $currentLevelIndex }}</h3>
	<hr>

	{!! Form::open(['action' => 'LevelsController@store']) !!}
				
		<div class="form-group">
			{!! Form::label('title', 'Titulo del Nivel:') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('description', 'Descripcion:') !!}	
			{!! Form::text('description', null, ['class'=>'form-control']) !!}	
		</div>

		
		<h3>Agregar Lecciones a Nivel:</h3>
		<p>Lecciones actualmente no Asignadas a ningun Nivel</p>
		@if ( ! $unAssignedLessons->count() )

			<p>No existen Lecciones sin Asignacion:</p>

		@else
			<select multiple  class="form-control" name="lessons[]">
				@foreach ( $unAssignedLessons as $lesson )
				
					<option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
				
				@endforeach	
			</select>
		@endif
		<br>
		<hr>

		<input type="hidden" name="level_index" value="{{ $currentLevelIndex }}">

		{!! Form::submit( 'Crear Nivel' , ['class' => 'btn btn-primary form-control']) !!}	

	{!! Form::close() !!}

	@include('errors.list')	

@stop