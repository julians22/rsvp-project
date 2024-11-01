<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $appends = ['package'];


    public function getPackageAttribute()
    {
        if (isset($this->meta['food'])) {
            return $this->meta['food'];
        }
    }
}
