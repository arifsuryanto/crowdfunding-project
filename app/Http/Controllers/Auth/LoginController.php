<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email Not Found',
            ], 200);
        } else if ($user->email_verified_at == null) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email Not Verified, Please Verify Your Email First !',
            ], 200);
        } else if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Login Failed, Email and Password not Match !',
            ], 200);
        } else {
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Login Success!',
                'data' => $user,
                'token' => $token //bisa juga pake compact('token')
            ]);
        }
    }
}
