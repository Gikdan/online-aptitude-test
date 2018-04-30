<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	$user = User::where('email', '=', $request->username)
    		->orWhere('username', '=', $request->username)
    		->first();

        if ($user == null) {
            return [
                "error" => "invalid_credentials",
                "message" => "The user credentials were incorrect." 
            ];
        } 
    
    		return $this->passportLogin($request);
    }

    private function passportLogin(Request $request)
    { 
    	$new_request = Request::create('oauth/token', 'POST', [
            'client_id' => env('PASSWORD_GRANT_CLIENT_ID'),
            'client_secret' => env('PASSWORD_GRANT_CLIENT_SECRET'),
            'username' => $request->username,
            'password' => $request->password,
            'grant_type' => 'password',
            'scope' => ''
        ]);

        $new_request->headers->set('Origin', '*');
        return app()->handle($new_request);
    }

   

    public function init()
    {
        return [
            'auth_user' => auth_user()
        ];
    }

    public function logout(Request $request)
    {
    	$request->user()->token()->revoke();

        return [
            'success' => 1,
        ];
    }

}
