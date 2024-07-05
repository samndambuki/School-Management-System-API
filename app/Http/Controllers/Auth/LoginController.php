<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //$request contains info about http requests
    public function login(Request $request)
    {
        //extracts the email and password
        $credentials = $request->only('email', 'password');
        //checks the credentials against the records in th database
        if (Auth::attempt($credentials)) {
            //regenerates session id
            //ensures session is secure after login
            $request->session()->regenerate();
            return response()->json(['message' => 'login successful'], 200);
        }
        return response()->json(['message' => 'invalid credentials'], 401);
    }
}
