<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\otp;
use App\Models\User;
use Carbon\Carbon;
use App\Events\UserRegisteredEvent;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {

        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->save();

        $now = Carbon::now();
        // add 5 mins to the current time
        $otpExpires = $now->addMinutes(5);

        $otp = new otp();
        $otp->code = mt_rand(100000, 999999);
        $otp->valid_until = $otpExpires;

        $user->otp_code()->save($otp);
        event(new UserRegisteredEvent($user));


        return response()->json([
            'response_code' => '00',
            'response_message' => 'Now you are registered ! Go Check Your Email',
            'data' => $user,
        ]);
    }
}
