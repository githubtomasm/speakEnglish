<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	protected $table = 'permissions';
	
	
	protected $basePermissions =  [
		'View Content' 			=> 'can_view', 		// regular user
		'Teachers'				=> 'can_edit', 		// teachers
		'Site Manager'			=> 'can_manage', 	//  manager account
		'Site Aministrator' 	=> 'can_admin',		// super admin
	];


	protected static $defaultPermissionName = 'can_view';



	static public function getDefaultPermissionName ()
	{
		return self::$defaultPermissionName;
	}


	

	/**
	* ---------------
	* RELATION SHIPS 
	* ---------------
	* Role Model
	*/
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }




}