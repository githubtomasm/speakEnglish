@extends('layout')


@section('content')
	
	<h1>RESET Your password:</h1>
	<hr>

	<!-- resources/views/auth/password.blade.php -->
	<form method="POST" action="/password/email">
	    {!! csrf_field() !!}

	    <div clas="form-group">
	        Email
	        <input class="from-control" type="email" name="email" value="{{ old('email') }}">
	    </div>

	    <div clas="form-group">
	        <button class="btn btn-primary form-control" type="submit">
	            Send Password Reset Link
	        </button>
	    </div>
	</form>

@stop