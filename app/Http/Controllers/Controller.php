<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;



abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $user;


    /**
     * Create a helper variables that can be call from any controller and them enherit by the views to pass some basic information
     * is_user_logged_in: bool, validate if the user is logged it
     * give a instance of the user object
     */
    public function __construct ()
    {

    	$this->user = Auth::user();

    	view()->share( 'is_user_logged_in', Auth::check() );

    	view()->share( 'user', $this->user );

    }

}
