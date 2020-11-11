<?php
namespace App\Http\Controllers\Auth;

use App\Events\RegenerateOtpEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegenerateOtpRequest;
use App\Mail\RegenerateOtpMail;
use App\Models\otp;
use App\User;
use Carbon\Carbon;
use Mail;

class RegenerateOtpController extends Controller
{
['code' => $code, 'valid_until' => $otpExpires]
);

event(new RegenerateOtpEvent($user));

return response()->json([
'response_code' => '00',
'response_message' => 'OTP Code Has Been Sent to Your Email!',
}
?>