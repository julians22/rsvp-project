<?php

namespace App\Models;

use App\Casts\NullableEnum;
use App\Enums\VisitorType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use VisitorTypeCast;

class EventDetail extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'offline_foods' => 'array',
        'online_visitor_type_list' => 'array',
        'offline_visitor_type_list' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the online time in no seconds format.
     *
     * @return string
     */
    public function getOnlineTimeNoSecondsAttribute()
    {
        $onlinetime = $this->online_time;

        // Make the time in no seconds format & add PM/AM
        $time = date('h:i A', strtotime($onlinetime));
        return $time;
    }

    /**
     * Get the offline time in no seconds format.
     *
     * @return string
     */
    public function getOfflineTimeNoSecondsAttribute()
    {
        $offlinetime = $this->offline_time;
        $time = date('h:i A', strtotime($offlinetime));
        return $time;
    }

    /**
     * Get the offline food price in currency format, with K or M suffix.
     */
    public function getOfflineFoodPriceCurrencyAttribute()
    {
        $price = $this->offline_food_price;

        if ($price >= 1000000) {
            $price = $price / 1000000;
            $price = number_format($price, 0) . 'M';
        } else {
            $price = $price / 1000;
            $price = number_format($price, 0) . 'K';
        }

        return $price;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video')
            ->useFallbackUrl(asset('videos/BNI Video low.mp4'))
            ->singleFile();
    }
}
