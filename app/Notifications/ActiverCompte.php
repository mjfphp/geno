<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActiverCompte extends Notification
{
    use Queueable;
    protected  $mail;

    public function __construct($mail,$pass)
    {
         $this->mail=$mail;
         $this->pass=$pass;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Salamo alikom vous pouvez activer votre compte sur la plateforme gestion des notes \n Votre mail est : '.$this->mail
                    .' \n votre password  : '.$this->pass)
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
