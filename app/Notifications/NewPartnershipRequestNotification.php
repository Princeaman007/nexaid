<?php

namespace App\Notifications;

use App\Models\PartnershipRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPartnershipRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public PartnershipRequest $partnershipRequest
    ) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Partnership Request - ' . $this->partnershipRequest->name)
            ->greeting('Hello!')
            ->line('A new partnership request has been submitted.')
            ->line('**Company:** ' . $this->partnershipRequest->name)
            ->line('**Email:** ' . $this->partnershipRequest->email)
            ->line('**Partnership Type:** ' . ($this->partnershipRequest->partnership_type ?? 'Not specified'))
            ->line('**Budget Range:** ' . $this->partnershipRequest->formatted_budget)
            ->line('**Services Needed:** ' . $this->partnershipRequest->services_string)
            ->action('View Request', url('/admin/partnership-requests/' . $this->partnershipRequest->id))
            ->line('Please review this request in the admin panel.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'partnership_request_id' => $this->partnershipRequest->id,
            'company_name' => $this->partnershipRequest->name,
            'email' => $this->partnershipRequest->email,
            'partnership_type' => $this->partnershipRequest->partnership_type,
            'budget_range' => $this->partnershipRequest->budget_range,
            'message' => "New partnership request from {$this->partnershipRequest->name}",
        ];
    }
}