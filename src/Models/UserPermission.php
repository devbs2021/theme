<?php

namespace DevbShrestha\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $_fillable = [
        'user_id',
        'permissions',
        'deleted_at',
    ];

    // protected $casts = [

    //     'permissions'=>'array'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
