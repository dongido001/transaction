<?php

namespace App\Auth;

use App\Helpers\AuthRequest;
use Illuminate\Http\Request;

class AuthManager{

    /**
    * Super admin role
    * @var
    */
    const SUPER_ADMIN = 'sadmin';

    /**
    * Admin role
    * @var
    */
    const ADMIN = 'admin';

    /**
    * Quality Control
    * @var
    */
    const QC = 'qc';

    /**
    * Data entry
    * @var
    */
    const DATA_ENTRY = 'dataentry';

    /**
    * Normal User
    * @var
    */
    const NORMAL_USER = 'user';

    public static $roles = [
        self::SUPER_ADMIN,
        self::ADMIN,
        self::QC,
        self::NORMAL_USER,
        self::DATA_ENTRY,
    ];

    public function login($params) {
        $response = (new AuthRequest)->login($params);

        if(array_get($response,'status') !== 'success') {
            return array_get($response,'message','Invalid username and password combination');
        }

        return array_get($response,'data',[]);
    }

    public function logout() {
        return session()->forget('auth_user');
    }

    public function getLoggedInUser(){
        return session('auth_user');
    }

    public function getAllUsers()
    {
        $response = (new AuthRequest)->getAllUsers();
        
        return array_get($response,'data',[]);
    }

}