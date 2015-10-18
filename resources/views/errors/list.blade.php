
{{-- display any errors on the page --}}
@if( $errors->any() )
	<ul class="alert alert-danger">
		
		@foreach ( $errors->all()  as $error )
			
			<li> {{ $error }} </li>

		@endforeach

	</ul>
@endif	