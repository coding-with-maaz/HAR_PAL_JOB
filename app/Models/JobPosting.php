<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobPosting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'requirements',
        'responsibilities',
        'location',
        'employment_type',
        'experience_level',
        'salary_min',
        'salary_max',
        'salary_currency',
        'department',
        'remote_allowed',
        'skills_required',
        'benefits',
        'application_deadline',
        'is_active',
        'company_id',
        'posted_by',
        'easy_apply',
        'views_count',
        'status',
        'views'
    ];

    protected $casts = [
        'requirements' => 'array',
        'benefits' => 'array',
        'remote' => 'boolean',
        'views' => 'integer',
        'skills_required' => 'array',
        'remote_allowed' => 'boolean',
        'easy_apply' => 'boolean',
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'applications_count' => 'integer',
        'application_deadline' => 'date',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            $job->slug = static::generateUniqueSlug($job->title);
        });

        static::updating(function ($job) {
            if ($job->isDirty('title')) {
                $job->slug = static::generateUniqueSlug($job->title);
            }
        });
    }

    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function tags()
    {
        return $this->belongsToMany(JobTag::class, 'job_posting_tag', 'job_posting_id', 'job_tag_id');
    }

    public function incrementViewsCount()
    {
        $this->increment('views_count');
    }

    public function getFormattedSalaryRangeAttribute()
    {
        if (!$this->salary_min && !$this->salary_max) {
            return 'Salary not specified';
        }

        if (!$this->salary_max) {
            return "From {$this->salary_currency} " . number_format($this->salary_min);
        }

        if (!$this->salary_min) {
            return "Up to {$this->salary_currency} " . number_format($this->salary_max);
        }

        return "{$this->salary_currency} " . number_format($this->salary_min) . ' - ' . number_format($this->salary_max);
    }

    public function getFormattedSkillsRequiredAttribute()
    {
        if (!$this->skills_required || !is_array($this->skills_required)) {
            return [];
        }
        return array_map(function($skill) {
            return is_string($skill) ? $skill : json_encode($skill);
        }, $this->skills_required);
    }

    public function getFormattedBenefitsAttribute()
    {
        if (!$this->benefits || !is_array($this->benefits)) {
            return [];
        }
        return array_map(function($benefit) {
            return is_string($benefit) ? $benefit : json_encode($benefit);
        }, $this->benefits);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRemoteJobs($query)
    {
        return $query->where('remote_allowed', true);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('company', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        });

        $query->when($filters['department'] ?? false, function ($query, $department) {
            $query->where('department', $department);
        });

        $query->when($filters['employment_type'] ?? false, function ($query, $type) {
            $query->where('employment_type', $type);
        });

        $query->when($filters['experience_level'] ?? false, function ($query, $level) {
            $query->where('experience_level', $level);
        });

        $query->when($filters['remote'] ?? false, function ($query) {
            $query->where('remote_allowed', true);
        });

        return $query;
    }
} 