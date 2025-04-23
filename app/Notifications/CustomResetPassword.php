<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url("/reset-password/{$this->token}?email={$notifiable->getEmailForPasswordReset()}");

        return (new MailMessage)
            ->subject('【パスワード再設定】のご案内')
            ->markdown('emails.reset-password', [
                'resetUrl' => $resetUrl,
                'user' => $notifiable,
            ]);
    }
}