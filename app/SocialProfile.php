<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{

    # The database table used by the model.
    protected $table = 'social_profiles';

    protected $fillable = ['provider', 'provider_id', 'avatar', 'user_id'];



    /**
     * Relationship with User Model
     * one to Many
     */
    public function user ()
    {
    	$this->belongsTo('App\User');
    }
}
