<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'website',
        'industry',
        'company_size',
        'founded_year',
        'headquarters',
        'social_links',
        'is_featured',
        'is_verified',
        'status',
        'is_public'
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
        'is_public' => 'boolean',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    // Helper methods
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isPublic()
    {
        return $this->is_public;
    }

    // Boot method for automatic slug generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            if (empty($company->slug)) {
                $company->slug = \Str::slug($company->name);
            }
        });
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }

        // Generate a gradient background based on the company name
        $colors = [
            'from-indigo-500 to-purple-600',
            'from-blue-500 to-cyan-600',
            'from-green-500 to-emerald-600',
            'from-red-500 to-pink-600',
            'from-yellow-500 to-orange-600'
        ];
        
        $colorIndex = crc32($this->name) % count($colors);
        $gradient = $colors[$colorIndex];
        
        return "data:image/svg+xml;utf8," . rawurlencode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">' .
            '<defs><linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">' .
            '<stop offset="0%" style="stop-color:rgb(99,102,241);stop-opacity:1" />' .
            '<stop offset="100%" style="stop-color:rgb(147,51,234);stop-opacity:1" />' .
            '</linearGradient></defs>' .
            '<rect width="200" height="200" fill="url(#grad)" />' .
            '<text x="50%" y="50%" font-family="Arial" font-size="80" fill="white" text-anchor="middle" dominant-baseline="middle">' .
            strtoupper(substr($this->name, 0, 1)) .
            '</text></svg>'
        );
    }

    public function getActiveJobsCountAttribute()
    {
        return $this->jobs()->where('is_active', true)->count();
    }

    public function getIndustryAttribute($value)
    {
        return $value ? (string) $value : null;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
} 