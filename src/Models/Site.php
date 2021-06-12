<?php

namespace DevbShrestha\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'favicon',
        'phone',
        'address',
        'introduction',
        'map',
        'facebook',
        'twitter',
        'google',
        'youtube',
        'working_hours',
        'email',
    ];

}
