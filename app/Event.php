<?php

namespace App;

use App\Filters\Event\EventFilters;
use App\Helpers\Slug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $guarded = [];

    protected $appends = ['formattedPrice', 'isAttending', 'isBookmarked', 'formattedStartDate'];

    protected $withCount = ['bookmarks', 'reservations'];
    // protected $with = [''];

    protected $dates = ['start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();

        $slug = new Slug();

        static::saving(function ($model) use ($slug) {
            $model->slug = $slug->createSlug($model->title);
        });

        static::deleting(function ($model) {
            Storage::delete($model->image);

            $model->categories()->detach();
        });
    }

    public function scopeFilter(Builder $builder, Request $request, $filters = [])
    {
        return (new EventFilters($request))->append($filters)->filter($builder);
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

        return (bool) $this->bookmarks()->where('user_id', $user->id)
            ->first()
        ;
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->bookmarks()
            ->where('user_id', auth()->id())
            ->exists()
        ;
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
            ->get()
        ;
    }

    public function getFeaturedEvents($limit = 5)
    {
        return $this->whereHas('bookmarks')
            ->orWhereHas('reservations')
            ->limit($limit)
            // ->orderBy('start_date', 'desc')
            ->get()->shuffle();
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price > 0 ? '&#8358; '.number_format($this->price / 100) : 'Free';
    }

    public function getIsAttendingAttribute()
    {
        return $this->reservations()
            ->where('user_id', auth()->id())
            ->exists()
        ;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value;
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->toDayDateTimeString();
    }
}
