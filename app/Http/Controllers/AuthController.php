<?php

namespace App\Http\Controllers;

use App\Auth\AuthManager;
use Illuminate\Http\Request;

class AuthController {

    public function __construct(){
        $this->data = [];
    }

    /**
     *  Handle login request
     *  forward to hng-auth AuthControl
     */
    public function login() {

        $params = [
            'email'     => array_get($_REQUEST,'email'),
            'password'  => array_get($_REQUEST,'password'),
            'otp'       => array_get($_REQUEST,'otp'),
            'use_otp'   => true
        ];

        $user = (new AuthManager)->login($params);
      
        if (empty($user) OR !is_array($user)) {
            $this->data['error'] = $user? $user : 'Error on log in';
            return $this->view('login', $this->data);            
        }

        session(['auth_user' => $user]);
        
        $intended_url = session('user_intended_url'); // Get user intended URL
        session()->forget('user_intended_url');


        return redirect($intended_url ? $intended_url : '/');
    }

    public function showLogin()
    {
        $activeUser = (new AuthManager)->getLoggedInUser();

        if(! empty($activeUser) ) {
            return redirect('/');
        }

        return $this->view('login', $this->data);
    }

    public function logout()
    {
		(new AuthManager)->logout();

        return redirect('/login');
	}

    /**
     * Load the view.
     *
     * @param  string $view
     * @param  array  $parameters
     * @return mixed
     */
    public function view($view, $parameters = [])
    {
        return app('view')->make($view, $parameters)->render();
    }
}



