<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v1\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        if(!$user){
                return response()->json(['error' => 'The provided email address is not registered.'], 422);
        }

        if(! Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Invalid Password'], 422);
        }

        $device = substr($request->userAgent() ?? '',0,255);
        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ]);
    }

}
