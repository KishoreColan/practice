<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function userList()
    {
    	$userList = User::get();
	  return response()->json(["message" => "User List successfully" ,"data" => $userList]);
    }

    public function login(Request $request)
    {
	   $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        // $credentials = ["email" => $request->email, "password" => $request->password];
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);


      $user = Auth::user();
      $tokenResult = $user->createToken('Personal Access Token');
        return response()->json([
        	'name' => $user->name,
            'access_token' => $tokenResult->accessToken,
        ]);
    }
}
