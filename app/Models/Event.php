<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory,
        HasSlug;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'start_date'])
            ->saveSlugsTo('slug');
    }


    public function detail()
    {
        return $this->hasOne(EventDetail::class, 'event_id', 'id');
    }

    /**
     * Scope a query to only include slug.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];


    /**
     * Get the event's url.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->detail()->exists() ? route('event.show', $this->slug) : '#';
    }

    /**
     * Get the event start date.
     * Format the date to human readable.
     * 05 November 2021
     *
     * @return string
     */
    public function getStartDateFormattedAttribute($value)
    {
        $date = Carbon::parse($this->start_date);

        return $date->translatedFormat('d F Y');
    }


}
