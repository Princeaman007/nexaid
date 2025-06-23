<?php

namespace App\Notifications;

use App\Models\PartnershipRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PartnershipRequestStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public PartnershipRequest $partnershipRequest,
        public string $previousStatus
    ) {}

    /**
     * Get the notification's delivery channels.
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
        $statusMessage = match($this->partnershipRequest->status) {
            'approved' => 'We are pleased to inform you that your partnership request has been approved!',
            'rejected' => 'Thank you for your interest. After careful review, we are unable to proceed with your partnership request at this time.',
            'in_review' => 'Your partnership request is currently under review by our team.',
            'contacted' => 'Our team will be in touch with you soon regarding your partnership request.',
            default => 'Your partnership request status has been updated.',
        };

        $mailMessage = (new MailMessage)
            ->subject('Partnership Request Update - ' . ucfirst($this->partnershipRequest->status))
            ->greeting('Hello,')
            ->line('We have an update regarding your partnership request submitted on ' . $this->partnershipRequest->created_at->format('M d, Y') . '.')
            ->line($statusMessage);

        if ($this->partnershipRequest->status === 'approved') {
            $mailMessage->line('Our business development team will contact you within the next 48 hours to discuss the next steps.');
        }

        if ($this->partnershipRequest->status === 'rejected') {
            $mailMessage->line('We encourage you to apply again in the future as our partnership needs evolve.');
        }

        if ($this->partnershipRequest->admin_notes) {
            $mailMessage->line('**Additional Notes:** ' . $this->partnershipRequest->admin_notes);
        }

        return $mailMessage
            ->line('Thank you for your interest in partnering with us.')
            ->salutation('Best regards, The Partnership Team');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'partnership_request_id' => $this->partnershipRequest->id,
            'company_name' => $this->partnershipRequest->name,
            'previous_status' => $this->previousStatus,
            'new_status' => $this->partnershipRequest->status,
            'message' => "Partnership request status updated to {$this->partnershipRequest->status}",
        ];
    }
}