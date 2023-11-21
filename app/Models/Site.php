<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_title',
        'company_name',
        'company_email',
        'company_phone',
        'address',
        'about_us',
        'fb_url',
        'twitter_url',
        'linkedin_url',
        'insta_url',
        'footer_title',
        'footer_url',
        'app_logo',
        'fav_icon',
    ];
}
