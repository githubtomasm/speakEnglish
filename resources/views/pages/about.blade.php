@extends('layout')

@section('content')
	<h1>about page</h1>
@stop


{{-- this will call a section footer only for this page --}}
@section('footer')
	
	<script>
		alert('this is the about page');
	</script>

@stop