<?php

namespace App\Http\Middleware;

use Closure;

use App\Role;


class RedirectIfCanNotEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $canEditRoles = Role::getCanEditRoles();
        
        $userRoles = $request->user()->hasRole( $canEditRoles );

        // validate if currently auth user has the necesary role to create a level
        if ( ! $userRoles ) {


            if ( $request->ajax() ) {

               
               return response('Unauthorized.', 401 );


            }else{

                // redirect back with data
                return redirect()->route('home');

            }

        }


        return $next($request);
    }
}
