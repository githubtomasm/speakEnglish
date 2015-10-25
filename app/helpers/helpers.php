<?php 



function flash ( $title = null , $message = null )
{

	$flash = app('App\Http\Flash');

	/**
	 * when no params are pass return the instance of the flash class to access methods on it like:
	 * flash->success(); 
	 * flash->error(); 
	 * flash->overlay();
	 * @return flash obj.
	 */
	if( func_num_args() == 0 ) {

		return $flash;
	}


	# call default flash mesage info
	# access directly by flash( $title, $message )
	return $flash->info( $title, $message );

}