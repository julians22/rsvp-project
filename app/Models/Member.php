<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Member extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('profile_photo')
            ->useFallbackUrl('/img/profile-default.png')
            ->useFallbackPath(public_path('/img/profile-default.png'));

        $this->addMediaCollection('company_logo');

    }
}
