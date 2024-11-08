<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ColisDeposeNotification extends Notification
{
    use Queueable;

    protected $expediteur;
    protected $destinataire;
    protected $colis;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($expediteur, $destinataire, $colis)
    {

        $this->expediteur = $expediteur;
        $this->destinataire = $destinataire;
        $this->colis = $colis;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Colis déposé')
            ->greeting("Bonjour, {$notifiable->name}")
            ->line("Nous vous informons que le colis numéro {$this->colis->num_colis} a été déposé.")
            ->line('Merci de nous faire confiance !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
