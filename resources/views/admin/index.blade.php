
{{-- 
Admin backend home 
	- bnts: 
		create level, (manager) 
		create lesson, 
		create volcabulary,
		create user, (manager)
	- profile 
	- users (manager)
	- config (admin)	
--}}

@extends('layout')


@section('content')

	<h1>Admin area</h1>


	@if( $is_user_logged_in )
			
		<h3>Wellcome {{ $user->first_name . " " . $user->last_name }}</h3>

	@endif

	
	<div class="row">
		<div class="col-xs-12">
			<a href="admin/levels/create" class="btn btn-primary btn-lg">
				Niveles
				<i class="fa fa-plus"></i>
			</a>


			<a href="" class="btn btn-primary btn-lg">
				Lecciones
				<i class="fa fa-plus"></i>
			</a>


			<a href="" class="btn btn-primary btn-lg">
				Crear Volcabulario
				<i class="fa fa-plus"></i>
			</a>				
		

			<a href="" class="btn btn-primary btn-lg">
				Perfil de usuario
				<i class="fa fa-user"></i>
			</a>

		</div>
	</div>	
	<hr>


	<h2>Panel de Aministracion:</h2>
	<div class="row">
		<div class="col-xs-12">
			

			<a href="" class="btn btn-primary btn-lg">
				Usuarios
				<i class="fa fa-users"></i>
			</a>


			<a href="" class="btn btn-primary btn-lg">
				Agregar Usuario
				<i class="fa fa-plus"></i>
			</a>


			<a href="" class="btn btn-primary btn-lg">
				Configuracion
				<i class="fa fa-plus"></i>
			</a>			


		</div>
	</div>	


@stop