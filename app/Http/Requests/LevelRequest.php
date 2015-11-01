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

    private $baseRules = [];



    /**
     * Determine if the user is authorized to make this request.
     *   
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     * http://laravel.com/api/5.0/Illuminate/Http/Request.html
     * http://laravel.com/api/5.1/Illuminate/Validation/Validator.html
     * @return array
     */
    public function rules()
    {


        $rules = [];    

        # validate if is a ajax request    
        if ( $this->ajax() ){

            $inputs = $this->capture()->all();


            # get the request method
            switch( $this->method() ):

                # create level
                case 'POST':
                {
                   $rules =  [
                        'title'         => 'required|min:3', // required with min legth of 3 chars
                        'description'   => 'required',
                    ];

                    # http://ericlbarnes.com/laravel-array-validation/        
                    if( isset($inputs['lessons']) && count($inputs['lessons']) ){

                        foreach ( $inputs['lessons'] as $lessonKey => $lessonId) {
                            $rules['lesson'. $lessonKey ] = 'required';
                        }

                    }


                    return $rules;
                }

                // UPDATE LEVEL INDEX FROM levels/index route
                case 'PUT': 
                {
                    if( isset( $inputs['levels'] ) ){

                        foreach ($inputs['levels'] as $key => $level) {

                            $rules['id']        = 'required';
                            $rules['index']     = 'required';

                        }

                    }
                }


                # UPDATE LEVEL
                case 'PATCH':
                {

                    # rules for basic information
                    if( isset( $inputs['title'])  ||  isset($input['description']) ){
                        
                        $rules['title']         = 'required|min:3';
                        $rules['description']   = 'required';

                    }


                    /**
                     * rules for adding or removing existing lesson to level ( adding lessons from pool ) 
                     * the value needs to have the id of the lesson been updated
                     */
                    # 
                    if( isset($inputs['update']) ){

                        $rules['update']  = 'required';

                    }

                    return $rules;

                }

                default: break;

            endswitch;

        }



        # regular http requests 
        $rules =  [
            'title'         => 'required|min:3', // required with min legth of 3 chars
            'description'   => 'required',
        ];

        return $rules;

    }
}
