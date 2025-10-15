<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        $url = url(config('app.url') . route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->view('emails.custom_reset_password', ['url' => $url,'name'=> $notifiable->name]);

            // ->line('Hello ' . $notifiable->name . ',')
            // ->line('You are receiving this email because we received a password reset request for your account.')
            // ->action('Reset Password', $url)
            // ->line('If you didn\'t request a password reset, no further action is required.')

    }
}

