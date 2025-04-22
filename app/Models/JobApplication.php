<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'applicant_id',
        'resume',
        'cover_letter',
        'answers',
        'status',
        'notes',
        'reviewed_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'reviewed_at' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_REVIEWED = 'reviewed';
    const STATUS_SHORTLISTED = 'shortlisted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accepted';

    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_REVIEWED,
        self::STATUS_SHORTLISTED,
        self::STATUS_REJECTED,
        self::STATUS_ACCEPTED,
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function job()
    {
        return $this->jobPosting();
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', self::STATUS_SHORTLISTED);
    }

    public function getStatusBadgeColorAttribute()
    {
        return [
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'shortlisted' => 'green',
            'rejected' => 'red',
            'accepted' => 'green',
        ][$this->status] ?? 'gray';
    }
} 