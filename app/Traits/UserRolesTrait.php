<?php 

namespace App\Traits;

use App\Role;

trait UserRolesTrait {

    /**
     * Rlationship with Role Class
     * belongsToMany
     * http://alexsears.com/article/adding-roles-to-laravel-users
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');        
    }



    /**
     * Find out if user has a specific role
     *
     * @param $name : string, name of the role to check || object || array
     * @return bool
     */
    public function hasRole( $name )
    {
        
        if( is_string( $name ) ){
            
            return $this->roles->contains('name', $name);
            /*
            return in_array($name, array_fetch($this->roles->toArray(), 'name'));
            foreach ($this->roles as  $role)
            {
                if ( $role->name == $name ) return true;
            } 
            */
        }
 

        if( is_array( $name ) ){

            $i = 0;
            while ( $i < count($name)) {
                
                $name[$i];

                if( $this->hasRole( $name[$i] ) ){

                    return true;
                } 

                $i++;
            }

        }


        /**
         * is the passed argument is a object
         * same result
         * return !! $name->interserc( $this->roles)->count()
         */
        if( is_object( $name ) ){ 
            foreach ($name as $role ) {

                if ($this->hasRole( $role->name )){
                    
                    return true;
                
                }
            }
        }
 
        return false;
    }
 



    /**
     * Attach a particular role to the user by adding it to the pivot table role_user
     *
     * @param $role : null || string || role object
     */
    public function assignRole ( $role )
    {

        $roleToAssign = $role;
        
        # assign default role of user
        # role needs to already exist in db
        if( $role === null ) {

            $defaultRole    = Role::getDefaultRoleName();
            $roleToAssign   = Role::whereName( $defaultRole )->firstOrFail();
            // $roleToAssign = Role::whereName( $defaultRole )->get()->first();

        }


        # if pass role is a string
        # fetch the role
        if( is_string( $role )){
            
            $roleToAssign = Role::whereName( $role )->firstOrFail();
            // $roleToAssign = Role::whereName( $role )->get()->first();
        }

        # save the given role
        return $this->roles()->save( $roleToAssign );     
        
    }



    /**
     * Remove a role from a user
     *
     * @param $role object
     */
    public function removeRole ( $role )
    {
        return $this->roles()->detach($role);
    }



    /**
     * Get users by role
     *
     * @param $roleName, string
     * @return collection, $users with passed role name 
     */
    public static function getUsersByRoleName ( $roleName )
    {
        return self::whereHas( 'roles', function ($q) use ($roleName) {
            $q->where('name', $roleName );
        } )->get();              
  
    }
    


}