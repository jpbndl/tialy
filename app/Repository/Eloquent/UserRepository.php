<?php

namespace App\Repository\Eloquent;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repository\Result\ResultMessage;

class UserRepository extends ResultMessage {
    public function login($request) {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){ 
            $user = Auth::user();
            $success['access_token'] =  $user->createToken('TIAlyToken')->accessToken; 
        
            return response()->json([
                'status' => 'success',
                'data' => $success,
                'id' => Auth::id(),
            ], 200);
        } else { 
            return response()->json([
                'status' => 'error',
                'data' => 'Invalid Credentials'
            ], 403); 
        }
    }
}

