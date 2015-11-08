@section('page-styles')

	<style>
		#data-table .ui-sortable-helper {
		    padding: 2px;
		    width: 50px;
		    height: 20px;
		    border: 1px solid #333;
		    background: #EEE;
		}
		
		#data-table .ui-state-highlight {
			background-color:#d9edf7;
			border: none;
		}

		#data-table .ui-state-highlight td {
			border:none;
		}

	</style>

@stop

@extends('layout')

@section('content')
	
	<script type="text/javascript">
	var levelId={{ $level->id }};
	//console.log(level_index);
	</script>
<div ng-app="editApp" ng-controller="editCtrl" id="app">
	<div class="jumbotron">

	  	<h1>Nivel # {{ $level->level_index }}</h1>
	  	<p> {{$level->title}}</p>
		<h5>Editar Nivel, Agregar Lecciones, Assets, etc </h5>		

	</div>

	<div class="row">
		<div  class="col-xs-12" style="margin-bottom:25px">
			<div>
				<h4>Título del Nivel</h4>
				<input type="text" class="form-control" ng-model="levelData.title">		
				<h4>Descripción del Nivel</h4>
				<input type="text" class="form-control" ng-model="levelData.description">		
			</div>	
		</div>

		<div class="col-xs-6">
			<h4>Lecciones Asociadas al Nivel</h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							Id
						</th>
						<th>
							Indice
						</th>
						<th>
							Titulo
						</th>
					</tr>
					<tr ng-if="levelLessons.length==0">
						<td>
							No hay lecciones asociadas a este nivel
						</td>
					</tr>
				</thead>
				<tbody ui-sortable='sortableOptions' class="lessonsConnect" ng-model="levelLessons">
					<tr ng-repeat="lesson in levelLessons | orderBy:'lesson_index' ">
						<td>
							{[{lesson.id}]}
						</td>
						<td>
							{[{lesson.lesson_index}]}
						</td>
						<td>
							{[{lesson.title}]}
						</td>
					</tr>

				</tbody>
			</table>
		</div>
		<div class="col-xs-6">
			<h4>Lecciones aún Asociadas a Niveles</h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							Id
						</th>
						<th>
							Titulo
						</th>
					</tr>
				</thead>
				<tbody ui-sortable='sortableOptions' class="lessonsConnect" ng-model="unassignedLessons">
					<tr ng-repeat="lesson in unassignedLessons | orderBy:id">
						<td>
							{[{lesson.id}]}
						</td>
						<td>
							{[{lesson.title}]}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-12">
		<center>
			<button>Crear Lección</button>
		</center>
	</div>
</div>
	

	@include('errors.list')	

@stop;
@section('page-scripts')

<script type="text/javascript" src="/assets/level-edit.js"></script>

@stop