<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LessonsController extends Controller
{

	/**
	 * Display all the lessons that belongs to a level
	 *
	 * @param $level_slug-> string	
	 * @return view
	 */
	public function index ( $level_slug )
	{
		return 'Display a list of all the lessons that belongs to a level';	
	}

	/**
	 * Display a lesson
	 *	
 	 * @param level_slug -> string
 	 * @param $lesson_id -> int
	 */
	public function show ($level_slug, $lesson_id )
	{
		return 'Display by ID a Lesson of a Level';
	}


	/**
	 * Create a Lesson 
	 */
	public function create ()
	{
		return view('lessons.create');
	}




}
