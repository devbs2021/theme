<?php

namespace Devbs\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;



class UserPermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'permissions',
        'deleted_at'
    ];

    // protected $casts = [

    //     'permissions'=>'array'
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
