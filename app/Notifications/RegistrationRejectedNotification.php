<?php
namespace App\Notifications;

use App\Models\CompanyRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private CompanyRegistration $registration,
        private string $reason
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre demande d\'inscription')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Malheureusement, nous ne pouvons pas donner suite à votre demande d\'inscription.')
            ->line('Motif : ' . $this->reason)
            ->line('N\'hésitez pas à nous contacter pour plus d\'informations.')
            ->action('Nous contacter', url('/contact'))
            ->line('Cordialement,');
    }
}