<?php

namespace DevbShrestha\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Menu extends Model
{
    use HasFactory;
    use HasSlug;

    use SoftDeletes;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
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
