<?php  

namespace App;

use Illuminate\Auth\Guard as Authenticator;

# use Socialite;
use Laravel\Socialite\Contracts\Factory as Socialite;

use App\Repositories\UserRepository;


/**
 * 
 *
 */
class AuthenticateUser {

	private $users;

	private $socialite;

	private $auth;


	/**
	 * 
	 *
	 */
	//Authenticator $auth
	public function __construct ( UserRepository $users,  Socialite $socialite, Authenticator $auth)
	{	
		$this->users 		= $users;
		$this->socialite 	= $socialite;
		$this->auth 		= $auth;
	}	
	

	/**
	 * Verify if code variable exist in querystring  
	 *
	 * @param hasCode, bool
	 * @param $listner, obj. link to the AuthController class
	 * @param provider, string
	 * @return  call to method userHasLoggedIn in AuthController class
	 */
	public function execute ( $hasCode, $listner, $provider )
	{
		
		# if the code var does not exist
		if( ! $hasCode ) 
			return  $this->getAuthorizationFirst($provider);

	
		# call findOrCreateSocialUser method  on UserRepository Class to find the passed user from oAuth API (socialite) in the db or created with the passed		
		$user = $this->users->findOrCreateSocialUser( $this->getProviderUser($provider), $provider );
		

		# login returned user and remember it
		$this->auth->login($user, true);


		# handles the logged user validations like roles and redirections
		return $listner->loggedUserRedirect($user);
	}



	/**
	 * Redirect to 3er party Api to get Auth.
	 *
	 * @param $provider: string 
	 * @return redirect to driver auth page
	 */
	public function getAuthorizationFirst ($provider)
	{
		# redirect to google to get auth token
		// return $this->socialite->driver('google')->redirect();
		return $this->socialite->driver($provider)->redirect();
	}

	/**
	 * Fetch User info from API
	 *
	 * @return Api with user data Object
	 */
	public function getProviderUser ($provider)
	{
        ################################################
        # NOTE: issue -> fix: https://laracasts.com/discuss/channels/general-discussion/laravel-socialite-problem 
		###############################################       
        // return $this->socialite->driver('google')->user();		
        return $this->socialite->driver($provider)->user();		
	}




}