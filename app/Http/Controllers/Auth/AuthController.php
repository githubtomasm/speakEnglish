<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Socialite;

use App\AuthenticateUser;

use Illuminate\Http\Request;


use Illuminate\Contracts\Auth\Guard;

use App\Repositories\userRepository;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $auth;

    protected $userRepo;

    protected $request;


    protected $redirectPath = '/'; 

    protected $loginPath = '/login';
    

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
    public function __construct( Guard $auth, UserRepository $userRepository, Request $request )
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    
        $this->auth                 = $auth;
        $this->userRepository       = $userRepository;
        $this->request              = $request;
    }




    /**
     * DISPLAY Register form
     *
     * @return view
     */
    public function getRegister()
    {
        return view('auth.register');
    }




    /**
     * Register user 
     *
     * @return view
     */
    public function postRegister( Request $request)
    {
        $input = $request->all();
        
        // $validator = Validator::make($input, User::$rules, User::$messages);
        $validator = Validator::make( $input, User::$rules, User::$messages );
        
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
    
        # Validte if there is a Role pass in through the create user form 
        isset($input['role']) && $input['role'] !== "" 
            ? $roleToAssign = $input['role']
            : $roleToAssign = null;
    
        # Validate f there is a permission pass throuth the form 
        isset( $input['permission'] ) && $input['permission'] !== "" 
            ? $permissionToAssign = $input['permission']
            : $permissionToAssign = null;


        $data = [
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'password'      => $input['password'],
            'role'          => $roleToAssign,
            'permission'    => $permissionToAssign,
        ];

        # register the user
        $user = $this->userRepository->register($data);

        # return redirect()->route('login')
        return redirect('login')    
            ->with('status', 'success')
            ->with('message', 'You are registered successfully. Please login.');
    }






    /**
     * Display Login form
     * @return view
     */
    public function getLogin()
    {
        return view('auth.login');
    }




    /**
     * Log the user In
     *
     * @return redirect to view
     */
    public function postLogin()
    {

        $input = $this->request->all();

        #get data pass by the login form
        $email      = $input['email'];
        $password   = $input['password'];

        isset($input['remember']) && $input['remember'] == 1 
            ? $remember = true 
            : $remember = false;

                
        if($this->auth->attempt([ 'email'  => $email,'password'  => $password], $remember ))
        {
            return $this->loggedUserRedirect($this->auth->user());

        }else{
            return redirect()->back()
                ->with('message','Email o Password Incorrectos')
                ->with('status', 'danger')
                ->withInput();
        }
    }





    /**
     * Logout users
     */
    public function getLogout()
    {
        \Auth::logout();

        return redirect('login')
            ->with('status', 'success')
            ->with('message', 'Logged out');

    }




    /**
     * fetch the redirection rout base on role
     * @return string
     */
    public function loggedUserRedirect ($user)
    {
        
        if( $user->hasRole('administrator') ){
            return redirect('admin');
        }        

        if( $user->hasRole('user') ){
            
            # home for logged users    
            return redirect('levels');
        
        }
    }
    



    /**
     * Validates if code var exists in the query string, then pass it down to the execute method on the AuthenticateUser Class 
     * 
     * @param $provider: string, any provider that it's pass (google, facebook, tweeter)
     */
    public function loginWithProvider ( $provider, AuthenticateUser $authenticateUser, Request $request )
    {

        /**
         * call the execute method on the AuthenticateUser class, and pass code variable in the querystring string if found 
         * if code is present means that user it's returning from google api 
         * $this will be use to access userHasLoggedIn method from AuthenticatieUser Model class and then redirect user 
         */
        return $authenticateUser->execute($request->has('code'), $this, $provider);
    }

}