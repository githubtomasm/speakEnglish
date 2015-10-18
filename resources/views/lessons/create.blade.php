@extends('layout')




@section('content')

	<h1>Create a new Lesson:</h1>
	<hr>

	{!! Form::open() !!}

		<div class="from-group">

			{!! Form::label('video_id', 'Input Youtube video Id / link') !!}
			{!! Form::text('video_id', null, ['class'=>'form-control']) !!}

		</div>			



		<div class="from-group">

			{!! Form::label('title', 'Lesson Title:') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}

		</div>					


		<div class="from-group">
			{!! Form::label('description', 'Lesson Description:') !!}
			{!! Form::text('description', null, ['class'=>'form-control']) !!}
		</div>					


		<h3>Select a Level for this Lesson:</h3>
		


	{!! Form::close() !!}
@stop