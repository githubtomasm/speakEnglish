@extends('layout')


@section('content')

	<h1>home page</h1>


	@if ( $is_user_logged_in )

		<h3> Wellcome {{ $user->first_name }} </h3>
		
	@endif

@stop