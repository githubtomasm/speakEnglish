<?php 

namespace App\Http;


class Flash {


	/**
	 * Add a KEY flash in laravel's sesion object
	 */
	public function create ( $title, $message, $level, $key = 'flash_message' )
	{
		# 
		session()->flash( $key, [
			'title' 	=> $title,
			'message'	=> $message,
			'level'		=> $level // default message state
		]);
		
	}


	public function info ( $title, $message )
	{
		return $this->create( $title, $message, 'info' );
	}


	public function success ( $title, $message )
	{
		return $this->create( $title, $message, 'success');		
	}


	public function error ( $title, $message )
	{	
		return $this->create( $title, $message, 'error' );
	}


	public function overlay ( $title, $message, $level )
	{
		return $this->create( $title, $message, $level, 'flash_message_overlay'  );
	}

} 