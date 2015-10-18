@extends('layout')


@section('content')
	<h1>Niveles</h1>
	<hr>

	
	<p style="padding:10px" class="bg-danger">
		<strong>note:</strong>
		Need to add a way to organize the Levels in this view by name or level_index <br> 		
		<strong>option:</strong><br> 
		Add buttons Order by: Title or Index, this will post to levels/order_by/{method}, then pass to the index method in the levelsController and replace the method pass in the elequent query <br>
		for each output it level add a input with the current level index and a way to swhitch index from here, this will update the database, then update the view ??? 
	</p>		
	
	@foreach ( $levels as $level )
		<h2>
			<!--
				Will output an uri base on the controller	
				action('LevelsController@show', [$level->id])
				LevelsController-> controller;
				show-> method
				second param
					$level->id : took it from the current loop

				OTHER METHOD:
					url('levels/' . $level->id )				
			-->	
			<a href="{{ action('LevelsController@show', [$level->id]) }}">{{ $level->title }}</a>
		</h2>
		
		<ul>
			<li><h4>Level Data:</h4></li>

			<li>
				<strong>Level Index: </strong> 
				{{ $level->level_index }}
			</li>

		
			<li>
				<strong>description: </strong> 
				{{ $level->description }}
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
				{{  $level->published_at }}
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

	@endforeach

@stop