<?php

namespace App\Providers;

use App\Permission;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    
    /*
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        # Register all permissions into the Gate contract And validate if the given user has any of the register permissions
        foreach ( $this->getPermissions() as $permission ){

            $gate->define( $permission->name, function ($user) use ($permission) {
                
                return $user->hasRole( $permission->roles );
                
            });
        }
    }
    */    
    


 
    /**
     * Fetch all roles from db 
     */
    protected function getPermissions ()
    {
        /**
         * Eloquent Eager Loading
         * allows to query directly to the relation ship table defined in the 
         * http://laravel.com/docs/4.2/eloquent#eager-loading
         */
        return Permission::with('roles')->get();
    }

}