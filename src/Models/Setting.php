<?php

namespace DevbShrestha\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $_fillable = [
        'module',
        'status',
    ];
}
