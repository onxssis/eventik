<?php

namespace App;

use App\Helpers\Slug;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();

        $slug = new Slug();

        static::saving(function ($model) use ($slug) {
            $model->slug = $slug->createSlug($model->title);
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
}
