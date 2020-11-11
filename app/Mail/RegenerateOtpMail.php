<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class RegenerateOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('123170059@student.upnyk.ac.id')
            ->view('mail/send_regenerate_otp')
            ->with([
                'otp_code' => $this->user->otp_code->code,
                'valid_until' => $this->user->otp_code->valid_until,
            ]);
    }
}
