<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
 
	public function __construct ()
	{
		
		# any routh associated with this controller will implemente the following middelware
		# user needs to be log in in order to access 
		$this->middleware('auth');


		# dalegae up to the Controller construct for additional methods that can be apply to any controller
		parent::__construct();
	}



	public function index ()
	{
	    return view('admin.index');
	}

}
