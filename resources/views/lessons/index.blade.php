@extends('layout')

@section('page-styles')
@stop


@section('content')
<style type="text/css">
.hiddenItem{
	display: none;
}

</style>


	<h1>Lessons</h1>
	<hr>

	<div class="row">
		<div class="col-xs-12">
		
			<div id="app" ng-controller="lesson-ctrl" ng-app="lessonApp">
				
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="cursor:pointer" ng-click="order='id'">Id</th>
							<th style="cursor:pointer" ng-click="order='level_id'">Level Parent</th>
							<th style="cursor:pointer" ng-click="order='title'">Title</th>
							<th style="cursor:default">Description</th>
							<th style="cursor:default">VideoKey</th>
							<th style="cursor:pointer" ng-click="order='user_id'">Author</th>
							<th style="cursor:pointer" ng-click="order='status_id'">Status</th>
							<th style="cursor:pointer" ng-click="order='created_at'">Created At</th>
							<th style="cursor:pointer" ng-click="order='publised_at'">Published At</th>
							<th style="cursor:pointer" ng-click="order='updated_at'">Edited At</th>
						</tr>

						<tr ng-hide="loadDocument" >
					 		<td colspan="10"><center>Loading</center></td>
					 	</tr>

						<tr class="hiddenItem" id="noHayLecciones">
							<td colspan="10">
							No hay Lecciones <a href="/admin/lessons/create">Crear una nueva Lección</a>
							</td>
						</tr>

					</thead>
					<tbody id="listaTabla" class="hiddenItem">
						<tr ng-repeat="lesson in lessonsData | orderBy: order">
							<td>
								{[{ lesson.id }]}
							</td>
							<td>
								<span ng-if="lesson.level_id==0">N/A</span><span ng-if="lesson.level_id!=0">{[{lesson.level_id}]}</span>
							</td>
							<td>
								{[{ lesson.title }]}
							</td>
							<td>
								{[{ lesson.description }]}
							</td>
							<td>
								{[{ lesson.video_id }]}
							</td>
							<td>
								{[{ lesson.user_id }]}
							</td>
							<td>
								{[{ lesson.status_id }]}
							</td>
							<td>
								{[{ lesson.created_at }]}
							</td>
							<td>
								{[{ lesson.published_at }]}
							</td>
							<td>
								{[{ lesson.updated_at }]}
							</td>
						</tr>
					</tbody>
				</table>

			</div>

		</div>
	</div>
	
@stop




@section('page-scripts')

<script type="text/javascript" src="/assets/lesson-table.js"></script>

@stop