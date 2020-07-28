<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Cupboard extends Model
{
    use HasSlug;

    protected $fillable = [
        'title'
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
     * Cupboard's cells
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
}
