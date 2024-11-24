<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResaDoneNotification extends Notification
{
    use Queueable;

    protected $passage;

    /**
     * Create a new notification instance.
     */
    public function __construct($passage)
    {
        //
        $this->passage = $passage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Reservation effectué')
                    ->greeting("Bonjour, {$notifiable->name}")
                    ->line("Nous vous informons que votre reservation de {$this->passage->direction} pour le {$this->passage->date} a été prise en cote.")
                    ->line('Merci de passe aupres de notre bureau pour procedé au payement')
                    ->action('Telechargé mom billet', url('/'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
