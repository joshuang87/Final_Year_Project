<?php

namespace App\Repositories\AdminRepositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function getInfo() 
    {
        return [
            'userInfo' => auth()->user()
        ];
    }

    public function logout(Request $request) 
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Out Successfully',
            'data' => $request->user()
        ],200);
    }

    public function updatePassword(Request $request)
    {
        return [
            auth('sanctum')->user()
        ];
        // $passwords = $request->validate([
        //     'oldPassword' => 'required|min:8',
        //     'newPassword' => 'required|min:8',
        //     'confirmPassword' => 'required|min:8'
        // ]);

        // $oldPassword = Auth::user()->getAuthPassword();

        // // If Old Password Is Correct
        // if(Hash::check($passwords['oldPassword'],$oldPassword))
        // {
        //     // If New Password Is Same As Old Password
        //     if(Hash::check($passwords['newPassword'],$oldPassword))
        //     {
        //         return response('New and Old Password Cannot Be Same',405);
        //     }
        //     // If New Password Is Not Same As Confirm Password
        //     elseif($passwords['newPassword'] != $passwords['confirmPassword'])
        //     {
        //         return response('New and Confirm Password Are Different',400);
        //     }
        //     // Hash New Password And Update
        //     else
        //     {
        //         $hashedPassword = Hash::make($passwords['newPassword']);
        //         $currentUserId = Auth::user()->id;
        //         User::where('id',$currentUserId)->update([
        //             'password' => $hashedPassword
        //         ]);

        //         return response('Password Updated',200);
        //     }
            
        // }
        // else
        // {
        //     return response('Original Password Wrong',401);
        // }
        
    }

}

?>