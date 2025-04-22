<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyApproved extends Notification implements ShouldQueue
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
            ->subject('Your Company Profile Has Been Approved')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Your company profile for ' . $this->company->name . ' has been approved.')
            ->line('You can now post jobs and manage your company profile.')
            ->action('View Company Profile', route('employer.company.show', $this->company))
            ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable): array
    {
        return [
            'company_id' => $this->company->id,
            'company_name' => $this->company->name,
            'status' => 'approved',
        ];
    }
} 