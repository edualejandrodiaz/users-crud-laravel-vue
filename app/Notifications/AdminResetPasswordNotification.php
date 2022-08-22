<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject( Lang::getFromJson('Solicitud de Cambio de Contraseña'))
            ->greeting( Lang::getFromJson('¡Hola!') )
            ->line(Lang::getFromJson('Se te ha enviado este email porque hemos recibido una solicitud de cambio de contraseña para tu cuenta.'))
            ->action(Lang::getFromJson('Cambio de Contraseña'), url(config('app.url').route('admin.password.reset-form', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false) ) )
            ->line(Lang::getFromJson('Este link de cambio de contraseña expirará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::getFromJson('Si tu no has hecho esta solicitud, entonces puedes ignorar este mensaje y nada pasará.'))
            ->salutation(Lang::getFromJson('¡Saludos!'));
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

}
