<?php

namespace Api\Facade\Auth\ForgotPassword;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $token
     */
    private $token;

    /**
     * Create a new message instance.
     * @param string $email
     * @return void
     */
    public function __construct(string $email,string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Reset password")
        ->markdown('Facade.Auth.ForgotPassword.view')
        ->with([
            'resetPasswordLink' => url('/reset/password?token='.$this->token.'&email='.$this->email)
        ]);
    }

}
