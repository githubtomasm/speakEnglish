<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

# allows to add nullable in foreign key
use App\Traits\NullableForeignKey;

class Lesson extends Model
{

	use NullableForeignKey;
	
	protected $nullableForeignKeys = ['level_id'];

	protected $table = 'lessons';


	protected $filable = [
		'title',
		'description',
		'video_id',
		'user_id',
		'level_id',
		'status_id',
		'published_at',
		'deleted_at',
	];


	/**
	 * --------------------
	 * MODEL RELATION SHIPS
	 * --------------------
	 * User
	 * Level
	 */
	public function user ()
	{
		return $this->belongsTo('App\User');
	}



	public function level ()
	{
		return $this->belongsTo('App\Level');
	}

}