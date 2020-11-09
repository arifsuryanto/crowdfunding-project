<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerificationRequest;
use App\Models\otp;
use App\Models\User;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerificationRequest $request)
    {
        $otp = otp::where('code', $request->code)->first();
        $now = Carbon::now();

        if (!$otp) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'OTP Code Not Found',
            ], 200);
        } else if ($now > $otp->valid_until) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'OTP Code was Expired, Generate New One',
            ], 200);
        } else {
            $user = User::find($otp->user_id);

            $user->email_verified_at = $now;
            $user->save();
            $otp->delete();

            return response()->json([
                'response_code' => '00',
                'response_message' => 'Welldone, your email are verified!',
                'data' => $user,
            ]);
        }
    }
}
