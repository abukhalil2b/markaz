<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class MessageReceived extends Notification
{
  
    public function __construct()
    {
        //
    }

   
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'description' => 'تنبيه وإشعار',
            'url' => url('message/index'),
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
