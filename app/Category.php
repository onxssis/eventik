<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::makeSlugFromTitle($model->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    protected static function makeSlugFromTitle($title)
    {
        $slug = str_slug($title);

        $query = Event::whereRaw("slug ~ '^{$slug}(-[0-9]+)?$'");

        if (app()->environment() === 'testing') {
            $query = Event::whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$'");
        }

        $count = $query->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
