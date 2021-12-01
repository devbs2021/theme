<?php

namespace DevbShrestha\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CMS extends Model
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

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'seo',
        'status',
        'cms_id',
        'icon',

    ];

    protected $casts =
        [
        'seo' => 'array',
    ];

    public function childs()
    {
        return $this->hasMany(CMS::class, 'cms_id');
    }
    public function parent()
    {
        return $this->belongsTo(CMS::class, 'cms_id', 'id');
    }

}
