<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::makeSlugFromTitle($model->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isBookmarkedByUser($user = null)
    {
        $user = $user ? : auth()->user();

        return (bool)Bookmark::where('user_id', $user->id)
            ->where('event_id', $this->id)
            ->first();
    }

    protected static function makeSlugFromTitle($title)
    {
        $slug = str_slug($title);

        $count = Event::whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUpcomingEvents($limit = 5)
    {
        $today = Carbon::today();

        return $this->where('start_date', '>', $today)
            ->limit($limit)
            ->orderBy('start_date', 'desc')
            ->get();
    }
}
