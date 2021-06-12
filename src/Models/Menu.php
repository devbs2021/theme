<?php

namespace DevbShrestha\Theme\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public const TYPES = [
        "HEADER",
        "FOOTER",
    ];

    protected $fillable = [
        'title',
        'link',
        'slug',
        'type',
        'position',
        'menu_id',
        'status',
        'page_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function page()
    {

        return $this->belongsTo(CMS::class, 'page_id');
    }
}
