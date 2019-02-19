<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $guarded = [];

    protected $appends = ['formattedPrice', 'isAttending', 'isBookmarked'];

    protected $withCount = ['bookmarks', 'reservations'];
    // protected $with = [''];

    protected $dates = ['start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::makeSlugFromTitle($model->title);
        });

        static::deleting(function ($model) {
            Storage::delete($model->image);

            $model->categories()->detach();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'event_id');
    }

    public function isBookmarkedByUser($user = null)
    {
        $user = $user ?: auth()->user();

        return !!$this->bookmarks()->where('user_id', $user->id)
            ->first();
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->bookmarks()
            ->where('user_id', auth()->id())
            ->exists();
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

    public function getFormattedPriceAttribute()
    {
        return $this->price > 0 ? '&#8358; ' . number_format($this->price / 100) : 'Free';
    }

    public function getIsAttendingAttribute()
    {
        return $this->reservations()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function setStartDateAttribute($value)
    {
        if (app()->environment() !== 'testing') {
            $this->attributes['start_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
        }

        $this->attributes['start_date'] = $value;
    }

    public function setEndDateAttribute($value)
    {
        if (app()->environment() !== 'testing') {
            $this->attributes['end_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
        }

        $this->attributes['end_date'] = $value;
    }

    // public function getStartDateAttribute()
    // {
    //     return $this->start_date->format('');
    // }
}
