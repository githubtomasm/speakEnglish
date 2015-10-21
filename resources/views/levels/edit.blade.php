@extends('layout')

@section('content')


	<div class="jumbotron">
	  	<h1>Nivel # {{ $level->level_index }}</h1>
		<p>Editar Nivel, Agregar Lecciones, Assets, etc </p>		
	</div>



	{{-- update basic info --}}
	<div class="row">
		
		{!! Form::model( $level, ['method' => 'PATCH']) !!}
		<div class="col-md-9">
			<div class="form-group">
				{!! Form::label('title', 'Titulo del Nivel:') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>


			<div class="form-group">
				{!! Form::label('description', 'Descripcion:') !!}	
				{!! Form::text('description', null, ['class'=>'form-control']) !!}	
			</div>

			

			<h3>Lecciones Asignadas a este Nivel</h3>	

			@if ( $assignedLessons->isEmpty() )
			
				<p>No existen lecciones assignadas a este nivel</p>

			@else

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Descripcion</th>							
							<th>Eliminar</th>
						</tr>
					</thead>
					

					<tbody>
						
						@foreach ( $assignedLessons as $lesson)
							<tr>
								<td>{{ $lesson->title }}</td>
								<td>{{ $lesson->description }}</td>
								<td><input type="checkbox" name="level_id[]" id="{{ $lesson->id }}"></td>
							</tr>
						@endforeach

					</tbody>
				
				</table>

			@endif	

		</div>
				

		
		<div class="col-md-3">

			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Acciones:</h3>
				</div>	
			
				<div class="panel-body">
					
					<button class="btn btn-block btn-danger">Eliminar</button>				

					{!! Form::submit('Actualizar', ['class' => 'btn btn-primary form-control']) !!}						
					
				</div>
			</div>
		
		</div>
		{!! Form::close() !!}	

	</div>	
	{{-- END basic info update --}}





	<h3>Agregar Lecciones:</h3>
	<hr>

	{{-- Add Lessons to level --}}
	<div class="row">
		
		<div class="col-md-9">
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				
				<div class="panel panel-default">
			    	<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Lecciones sin Asignar:
							</a>
						</h4>
			    	</div>
			    	
			    	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">

							@if ( $unAssignedLessons->count() )

								<select multiple  class="form-control" name="lessons[]">
									@foreach ( $unAssignedLessons as $lesson )
										<option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
									@endforeach	
								</select>
							@else
								
								<p>No hay lecciones sin asignacion.</p>

							@endif			
						
						</div>
			    	</div>
			  	</div>
			  


			  	<div class="panel panel-default">
			    	
			    	<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Crear Leccion Nueva:</a>
						</h4>
			    	</div>
			    	
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">

							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Titulo</th>
										<th>Descripcion</th>
										<th>Link de Video</th>
										<th>Respuesta de video</th>
									</tr>								
								</thead>
								
								<tbody>
									<tr><td colspan="4"></td></tr>
								</tbody>
									<tr>
										<td colspan="4">
											
											<a href="#" class="btn btn-primary btn-md">
												Agregar video
												<i class="fa fa-plus"></i>
											</a>	

										</td>
									</tr>
								<tfoot>
									
								</tfoot>
							</table>
						
						</div>
			    	</div>
			  	</div>

			</div>			

		</div>
		

		<div class="col-md-3">
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Acciones:</h3>
				</div>	
			
				<div class="panel-body">
					
					<button class="btn btn-block btn-info">Salvar y Asignar Lecciones</button>				

					
				</div>
			</div>
			
		</div>

	</div>


	@include('errors.list')	

@stop;