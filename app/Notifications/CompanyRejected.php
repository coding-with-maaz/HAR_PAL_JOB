<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Company Profile Needs Review')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your company profile for ' . $this->company->name . ' has not been approved at this time.')
            ->line('Please review and update your company information to ensure it meets our guidelines.')
            ->action('Edit Company Profile', route('employer.company.edit', $this->company))
            ->line('If you have any questions, please contact our support team.')
            ->line('Thank you for your understanding.');
    }

    public function toArray($notifiable): array
    {
        return [
            'company_id' => $this->company->id,
            'company_name' => $this->company->name,
            'status' => 'rejected',
        ];
    }
} 