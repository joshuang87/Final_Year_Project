<?php

namespace App\Repositories\AdminRepositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AdminInterfaces\AuthenticationRepositoryInterface;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{

    public function checkUser(Request $request)
    {

        $loginRequest = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);
    
        if(Auth::attempt($loginRequest)) {
            $token = auth()->user()->createToken(time())->plainTextToken;
            return response()->json(['token'=>$token,'message'=>'Login Successfully'],200);
            // return response('Login Successfully',200);
        }
        else {
            return response('Username or Password Incorrect',401);
        }
    }

    public function getInfo() {
        return [
            'userInfo' => auth()->user()
        ];
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Out Successfully',
            'data' => $request->user()
        ],200);
    }

}

?>