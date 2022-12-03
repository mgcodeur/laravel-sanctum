<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 401);
        }

        if (! auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        return response()->json([
            'message' => 'User Logged In Successfully',
            'access_token' => auth()->user()->createToken('api_token')->plainTextToken,
        ], 200);
    }
}
