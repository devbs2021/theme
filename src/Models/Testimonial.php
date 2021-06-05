<?php

namespace DevbShrestha\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $_fillable = [
        'name',
        'image',
        'message',
        'introduction',
        'status',
        'position',
    ];
}
