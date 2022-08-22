<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        
        $redirect = $this->getRedirectTo($request);
        
        return view('auth.login')->with('redirect', $redirect);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        
        
        
        
        $request->merge(['rut' => preg_replace('/[^0-9kK]/', '', $request->rut) ]);
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'rut';
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function GoogleredirectToProvider(Request $request)
    {
        $redirect = $this->getRedirectTo($request);
        if( !empty($redirect) ){
            $request->session()->put('redirectTo', $redirect);
        } 
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function GooglehandleProviderCallback(Request $request)
    {

        $redirect = $request->session()->get('redirectTo');

        if(!empty($redirect)){
            $this->redirectTo = $redirect;
        }


        

        try {
            $user = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver('google')->stateless()->user();
        }


        
        $arrUser['origin']              = 'google';
        $arrUser['firstname']           = $user->user['given_name'];
        $arrUser['lastname']            = ( isset( $user->user['family_name'] ) ) ? $user->user['family_name'] : 'Sin Apellido';
        $arrUser['email']               = $user->user['email'];
        $arrUser['image']               = $user->user['picture'];
        $arrUser['customer_group_id']   =  1;
        $arrUser['rut']                 = '15954845-7';

        $customerAuth = User::findOrCreate($arrUser);

        Auth::login($customerAuth, true);



        return redirect($this->redirectTo);
       

    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function FBredirectToProvider(Request $request)
    {
        $redirect = $this->getRedirectTo($request);
        if( !empty($redirect) ){
            $request->session()->put('redirectTo', $redirect);
        }        
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function FBhandleProviderCallback(Request $request)
    {

        $redirect = $request->session()->get('redirectTo');

        if(!empty($redirect)){
            $this->redirectTo = $redirect;
        }


        


        try {
            $user = Socialite::driver('facebook')->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver('facebook')->stateless()->user();
        }


  

        if( isset($user->user['name']) ){
            $nombres = explode(" ", $user->user['name']);
        }

        $arrUser['origin']              = 'facebook';
        $arrUser['firstname']           = ( isset( $nombres[0] ) ) ? $nombres[0] : 'Ninguno';
        $arrUser['lastname']            = ( isset( $nombres[1] ) ) ? $nombres[1] : 'Ninguno';
        $arrUser['email']               = ( isset( $user->user->email ) ) ? $user->user->email : $user->email;
        $arrUser['image']               = isset( $user->user['picture'] ) ? $user->user['picture'] : '';
        $arrUser['customer_group_id']   =  1;
        $arrUser['rut']                 = '15954845-7';

        $customerAuth = User::findOrCreate($arrUser);

        Auth::login($customerAuth, true);



        return redirect($this->redirectTo);
    }

    protected function getRedirectTo(Request $request){
        $redirect = '';

        if($request->redirectTo){
            if($request->redirectTo=='cart'){
                $redirect = route('cart', 0);
            } else if($request->redirectTo=='products'){
                $redirect = route('products');
            }

        }

        return $redirect;
    }

}
