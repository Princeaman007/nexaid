<?php
namespace App\Notifications;

use App\Models\CompanyRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private CompanyRegistration $registration
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $typeLabel = match($this->registration->type) {
            'hiring' => 'recrutement',
            'partnership' => 'partenariat',
            'offer_sender' => 'publication d\'offres',
            default => 'inscription'
        };

        return (new MailMessage)
            ->subject('Votre demande de ' . $typeLabel . ' a été approuvée')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Nous avons le plaisir de vous informer que votre demande de ' . $typeLabel . ' a été approuvée.')
            ->line('Vous pouvez désormais accéder à nos services.')
            ->action('Accéder à votre espace', url('/company/dashboard'))
            ->line('Merci de nous faire confiance !');
    }
}
