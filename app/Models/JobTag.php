<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    use HasFactory;

    protected $table = 'job_tags';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'job_posting_tag', 'job_tag_id', 'job_posting_id');
    }
} 