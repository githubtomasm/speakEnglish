<?php  
namespace App\Repositories;

use App\User;

use App\Password;

use App\Role;

use App\SocialProfile;

//use App\Http\Controllers\Auth\AuthController;


// use App\Logic\Mailers\UserMailer;

use Hash, Carbon\Carbon;


Class UserRepository {

	protected $user;

    protected $socialProfile;

    protected $role;

    // protected $userMailer;


    public function __construct( User $user, SocialProfile $socialProfile, Role $role )
    {	
    	// UserMailer $userMailer
        // $this->userMailer = $userMailer;
   	
    	$this->user = $user;
        
        $this->socialProfile = $socialProfile; 
   
        $this->role = $role;
    }




	/**
	 * SOCIALITE USERS:
	 * https://laracasts.com/discuss/channels/requests/complete-register-and-login-app-with-socialite-and-multiple-providers/?page=1
	 * https://www.youtube.com/watch?v=tq24CY8gA4I
     *
     * @param $socialiteUser, obj, returned obj by 3er party provider   
	 * @param $provider, string (google, facebook, tweeter..) 
     * @return user, obj, created/founded user
     */
	public function findOrCreateSocialUser ($socialiteUser, $provider)
	{	
         
        # check if the user exist in the db
        $userCheck = $this->checkInDd( $this->user, 'email',  $socialiteUser->email );

        if( ! empty( $userCheck )){
        # user founded with with provider email

            $user = $userCheck;

            #alternative $this->socialProfile->firstOrCreate();            
            $socialId = $this->socialProfile->where('provider_id', '=', $socialiteUser->id)->where('user_id', '=', $user->id )->where('provider', '=', $provider )->first();

            
            if( empty($socialId) ){
            # no social id founded    
            #create the social profile for the founded user
                $this->registerSocialProfile ( $socialiteUser, $provider, $user->id );
            }

        }else{
        # no user founded with provider email    

            #create the user
            $user = $this->register( $socialiteUser, true );
            
            # add the social profile
            $this->registerSocialProfile ( $socialiteUser, $provider, $user->id );

        }
                 
        
        return $user;
	}



    /**
     * Check if user exist 
     *
     * @param tableField , string, field users to perform serch
     * @param dataCheck, string, data to find 
     * @param model. model, eloquent model for table 
     */
    public function checkInDd( $model, $tableField, $dataToCheck   )
    {
        // User::where('email', '=', $user->email)->first()
        return $model->where( $tableField, '=', $dataToCheck )->first();                
    }    




    /**
     * Register Social Profiles
     */
    public function registerSocialProfile ($socialUser, $provider, $userId)
    {
        $this->socialProfile->create([
            'provider'      => $provider,
            'provider_id'   => $socialUser->id,
            'avatar'        => $socialUser->avatar,
            'user_id'       => $userId,
        ]);
    }



	/**
	 * Register User && Add Role && permission
	 *
	 * @param array, user data to register
     * @param listener, Obj, callback fn for AuthController@looggedUserRedirect 
	 * @param isSocial, bool, definies if the user to be created comes from social provider or regular register
     */
	public function register( $data, $isSocial = false )
    {

        $permissionToAssign = null;
        $roleToAssign       = null;

        /**
         * user register through social media provider generate a random psw
         * fetch basic data base on provider response object
         */
        if ( $isSocial ){
            $first_name     = $data->user['name']['givenName'];
            $last_name      = $data->user['name']['familyName'];
            $email          = $data->email;
            $password       = bcrypt(str_random(8));
        
        }else{
            
            $first_name     = $data['first_name'];
            $last_name      = $data['last_name'];
            $email          = $data['email'];
            $password       = Hash::make($data['password']);
        } 

        
        $user = $this->user->create([
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'email'         => $email,        
            'password'      => $password,
        ]);    


        # role pass by the register user form
        if( isset( $data['role'] ) ){

            $roleToAssign = $data['role'];
        } 

        

        if( isset( $data['permission'] )){

            $permissionToAssign = $data['permission'];       
        }


        # assign a role to the user, use the pass role  or fallback to a default role
        $user->assignRole( $roleToAssign ); 
       
        return $user;
    }



    /*
*     * Reset Password
     *
     * @Param User Obj
     */
    /*
    public function resetPassword( User $user  )
    {
        $token = sha1(mt_rand());
        $password = new Password;
        $password->email = $user->email;
        $password->token = $token;
        $password->created_at = Carbon::now();
        $password->save();

        $data = [
            'first_name'    => $user->first_name,
            'token'         => $token,
            'subject'       => 'Example.com: Password Reset Link',
            'email'         => $user->email
        ];

        $this->userMailer->passwordReset($user->email, $data);
    }
	*/

}