<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Role;

use Illuminate\Support\Facades\Auth;


/**
 * Validation for Form Create Levels
 */
class LevelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $canEditRoles = Role::getCanEditRoles();
        
        $userRoles = Auth::user()->hasRole( $canEditRoles );

        // validate if currently auth user has the necesary role to create a level
        if ( $userRoles ) {

            return true;

        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /**
         * this are rules for validation
         * in this scenario this validation will serve for update and create forms
         */

        return [
            'title'         => 'required|min:3', // required with min legth of 3 chars
            'description'   => 'required',
        ];

        /**
         * this will be for a scenario where update and create forms need a set of diffrent rules
         *
         */

        /*

            rules = [
                'rule_key' => 'rule definitaion',
                'rule_key' => 'rule definitaion',
            ]
            
            # set identifier for each form and update the rules array
            if( is_update_form_by_url ){
                # append, overwrite set of rules
                rules = []
            }

                
            return rules;
            }
        */
    }
}
