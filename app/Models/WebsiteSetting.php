<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'contact_email',
        'contact_phone',
        'address',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'logo',
        'favicon',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics_id',
        'google_verification_code',
        'bing_verification_code',
        'og_image',
        'twitter_card_image'
    ];
} 