<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Permission;

class Role extends Model
{


	protected $filable = ['name', 'label']; 

	protected static $baseRoles = [ 'user', 'teacher', 'manager', 'administrator' ];

	protected static $defaultRoleName = 'user';


	protected static $canEditRoles = [
		'teacher', 'manager', 'administrator'
	];


	static public function getDefaultRoleName ()
	{	
		return self::$defaultRoleName;
	}


	static public function getCanEditRoles () 
	{
		return self::$canEditRoles;
	}



	/*
	* --------------------
	* Model RELATION SHIPS 
	* --------------------
	* Users Model
	* Permissions Model
	*/
	
	public function users()
	{	
		return $this->belongsToMany('App\User');			
	}


	

	public function permissions()
	{
		return $this->belongsToMany('App\Permission')->withTimeStamps();
	}


	

	/**
	 * Gives permission to a Role, to execute a specifc task ( can_view, can_edit, can_manage )
	 * Link the role and permission tables in the role_permission table
	 *
	 * @param $Permissions null || string || permission obj 
	 */
	/*
	public function addPermissionTo ( $permission )
	{

		$permissionToAssign = $permission;

		if ( $permission === null ){

			$defaultPermission = Permission::getDefaultPermissionName();
				

			$permissionToAssign = Permission::whereName( $defaultPermission )->get()->first();

		}


		if ( is_string( $permission ) ){

			$permissionToAssign = Permission::whereName( $permission )->get()->first();

		}


		return $this->permissions()->save( $permissionToAssign );
	}
	*/
}
