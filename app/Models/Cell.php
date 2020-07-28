<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cell extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'cupboard_id'
    ];

    /**
     * Get the options for generating the slug
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key name for the model
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Cell's cupboard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cupboard()
    {
        return $this->belongsTo(Cupboard::class);
    }

    /**
     * Cell's folders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
