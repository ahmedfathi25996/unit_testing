<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    function login(Request $request)
    {
        dd("hre");
        $data = $request->all();
        $request->validate([
           "email" => "required",
           "password" => "required"
        ]);
        $login = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        if($login)
        {
            $user = Auth::user();
            $user->token = $user->createToken('MyApp')->accessToken;
            return response()->json($user, '200');

        }else{
            return response()->json("invalid login", '404');

        }

    }


}
