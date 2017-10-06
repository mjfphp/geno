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
        return (new MailMessage)->view("mail.active",['mail' => $this->mail,"pass" => $this->pass]);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
