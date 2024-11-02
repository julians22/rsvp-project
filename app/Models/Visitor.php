<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Visitor extends Model
{
    use HasFactory;

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
        'meta' => 'array',
        'is_offline' => 'boolean',
        'is_online' => 'boolean'
    ];

    /**
     * Get the event that owns the visitor.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['package', 'payment_path_url'];


    public function getPackageAttribute()
    {
        if (isset($this->meta['offline_food'])) {
            return $this->meta['offline_food'];
        }
    }

    public function getPaymentPathUrlAttribute()
    {
        if (!$this->is_offline) {
            return null;
        }

        if (isset($this->meta['payment_path'])) {
            $path = $this->meta['payment_path'];

            return $path ? Storage::disk('payments')->url($path) : null;
        }
    }
}
