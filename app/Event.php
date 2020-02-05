<?php

namespace App;

use App\Filters\Event\EventFilters;
use App\Helpers\Queries;
use App\Helpers\Slug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;

class Event extends Model
{
    use PostgisTrait;

    protected $guarded = [];

    protected $appends = ['formattedPrice', 'isAttending', 'isBookmarked', 'formattedStartDate', 'formattedDate'];

    protected $withCount = ['bookmarks', 'reservations'];
    // protected $with = [''];

    protected $dates = ['start_date', 'end_date'];

    protected $postgisFields = [
        'location',
    ];

    protected $postgisTypes = [
        'location' => [
            'geomtype' => 'geometry',
            'srid' => 4326,
        ],
    ];

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

    public function scopeGetEventsNearby(Builder $builder, $point = null, $operator = '<=', $distance = 19000, $limit = 8)
    {
        return Queries::getEventsNearby($builder, $point, $operator, $distance, $limit);
    }

    public function scopeMyTickets(Builder $query)
    {
        return $query->whereHas('reservations', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
    }

    public function scopeSavedEvents(Builder $query)
    {
        return $query->whereHas('bookmarks', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
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
            ->first();
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->bookmarks()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getRouteKeyName()
    {
        return 'slug';
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

    public function getFormattedDateAttribute()
    {
        return $this->start_date->format('jS F, Y g:i a');
    }

    public function setLocationAttribute($value)
    {
        $latLng = explode(' ', $value);
        $latitude = $latLng[0];
        $longitude = $latLng[1];
        $this->attributes['location'] = DB::raw("ST_SetSRID(ST_MakePoint({$latitude}, {$longitude}), 4326)");
    }

    public function getLocationAttribute()
    {
        $latlng = explode(' ', $this->attributes['location']);

        return [
            'lat' => $latlng[1],
            'lng' => $latlng[0],
        ];
    }
}
