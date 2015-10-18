@extends('layout')

@section('content')


	<h1>{{ $level->title }}</h1>	

	<ul>
		<li><h4>Single Data:</h4></li>
		
		<li>
			<strong>description: </strong> 
			{{  $level->description }}
		</li>
		
		<li>
			<strong>state: </strong> 
			{{  $level->state }}
		</li>
		
		<li>
			<strong>created_by: </strong> 
			{{  $level->created_by }}
		</li>
		
		<li>
			<strong>updated_by: </strong> 
			{{  $level->updated_by }}
		</li>
		
		<li>
			<strong>tags: </strong> 
			{{  $level->tags }}
		</li>
		
		<li>
			<strong>publish_at: </strong> 
			{{  $level->publish_at }}
		</li>
		
		<li>
			<strong>deleted_at: </strong> 
			{{  $level->deleted_at }}
		</li>
		
		<li>
			<strong>created_at: </strong> 
			{{  $level->created_at }}
		</li>
		
		<li>
			<strong>updated_at: </strong> 
			{{  $level->updated_at }}
		</li>
	</ul>



@stop