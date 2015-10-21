<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

/**
* this reprecent a table in the dabase table name Lavels
*
*/
class Level extends Model
{

	/**
	* Allows Eloquent to mass Assign to  this table the specified fields
	*	Apply to fields that wont represent any risk when mass Assing
	*	mass assign methods like 
	*		::update($array) 
	*		::create($ array) 	
	*/
	protected $fillable = [
		'user_id', // remove this one
		'level_index',
		'title',
		'description',
		'state',
		'updated_by',
		'tags',
		'published_at',
		'deleted_at',
	];


	// this will convert this row into a carbon instance
	protected $dates = ['published_at'];



	/**
	 * Fetch the last added Level in the DB then gets the level index of it 
	 * @return int, level_index 
	 */
	public static function lastLelveIndex()
	{
		# parent refers to the model class 	
		$currentIndex = parent::latest('id')->first();
		
		( $currentIndex ) 
			? $currentLevelIndex = $currentIndex->level_index + 1
			: $currentLevelIndex = 1;

		return $currentLevelIndex;
	}


	/**
	 * MUTATOR
	 * SETTING attributes for published_at that comes from post create form before reaches the db	
	 * Naming combetion:
	 * set . NameOfTheColumn . Attribute
	 * any underscore in the name of the table remove it and add chamolcase
	 */
	public function  setPublishedAtAttribute($date)
	{
		# name of tha field in db parse data to 
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-d-d', $date);
	}



	/**
	 * Scope will allow to create query logic and output at will
	 * Naming combention:
	 * scope -> keyword 
	 * Published -> radom name assigned by developer
	 * @pass query -> refrence to the baser query 
	 * 
	 */
	public function scopePublished($query)
	{
		# extends the pass query and adds the this logic
		# I.E: $levels in index method inside LevelsController.php
		$query->where('published_at', '<=', Carbon::now());
	}


	/**
	 * QUERY SCOPE
	 * Scope for displaying unpublished Levels
	 */
	public function scopeUnpublish($query)
	{
		$query->where('published_at', '>', Carbon::now());
	}




	/**
	 * RELATIONSHIPS
	 * ARTICLE BELONG TO A USER
     * this map the relationship at laravel level, still needs to map the same connection for the database structure in the migration class for this table users    
	 */
	public function user()
	{
		/**
		 * maps a relationship one to one 
		 * belongsTo -> it's a custom reprecentation for the relationship, this could be anything (i.e $this->owner('App\User'))
		 * so to call the user that owns this level will $level->user()
		 */
		return $this->belongsTo('App\User');
	}


	public function lessons ()
	{	
		return $this->hasMany('App\Lesson');	
	}



	/**
	 * Update by user Relationship
	 */
	public function updaters ()
	{
		return $this->belongsToMany('App\User', 'level_updates');
	}


}
