<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCodeResetPass extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $codigo;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $codigo,  string $subject = 'Código de Verificación')
    {
        $this->user = $user;
        $this->codigo = $codigo;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject )->markdown('emails.sendcode');
    }
}
