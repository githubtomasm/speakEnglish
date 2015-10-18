{{-- <p class="bg-info"></p>		 --}}
<div class="form-group">
	{{-- create lebel for element --}}
	{{-- title-> name attr = title  --}}
	{{-- second param value = Title	 --}}
	{!! Form::label('title', 'Titulo del Nivel:') !!}

	{{-- creates text input element --}}
	{{-- title-> name attr = title --}}
	{{-- null-> value --}}
	{{-- [] -> pass any other attr to  element --}}
	{!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
	{!! Form::label('description', 'Descripcion:') !!}	
	{!! Form::text('description', null, ['class'=>'form-control']) !!}	
</div>


{{-- 
<h3>Asignar Tutores a este Nivel:</h3>
@if ( ! $teachers->count() )

	<p>No existen Tutores en el sistema:</p>

@else
	<div class="checkbox">
		@foreach( $teachers as $teacher )
			<label>
				{!! Form::checkbox( $teacher->id, $teacher->id ) !!}
				{{ ucfirst( $teacher->first_name ) . " " . ucfirst( $teacher->last_name )  }}	
			</label>
		@endforeach
				
	</div>				
@endif
<br>
<hr>
 --}}



<h3>Agregar Lecciones a Nivel:</h3>
<p>Lecciones actualmente no Asignadas a ningun Nivel</p>
@if ( ! $unAssignedLessons->count() )

	<p>No existen Lecciones sin Asignacion:</p>

@else
	<select multiple  class="form-control" name="lessons[]">
		@foreach ( $unAssignedLessons as $lesson )
			{{--  
			{!! Form::select('size', 
				array( $lesson->id => 'lesson 1', 'lesson2' => 'lesson 2', 'lesson3' => 'lesson 3', 'lesson4' => 'lesson 4' ), // options
				'lesson1', // default value
				array('class'=>'form-control', 'multiple' => 'multiple')) // extra attr
			!!}
			--}}
			<option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
		@endforeach	
	</select>

@endif
<br>
<hr>

<input type="hidden" name="level_index" value="{{ $currentLevelIndex }}">

{{-- 
<div class="form-group">
	{!! Form::label('published_at', 'Publish On:') !!}	
	{!! Form::input('date', 'published_at', date('Y-m-d'), ['class'=>'form-control']) !!}	
</div>
<br>
<hr>

<div class="form-group">
	{!! Form::label('level_index', 'Level Index:') !!}
	{!! Form::text('level_index', $currentLevelIndex, ['class'=>'form-control']) !!}	
</div>
 --}}


{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary form-control']) !!}	

