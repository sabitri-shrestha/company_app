<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCompanyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Company Added')
            ->line('A new company has been added:')
            ->line('Name: ' . $this->company->name)
            ->line('Email: ' . $this->company->email)
            ->line('Website: ' . $this->company->website);
    }


}
