<?php

namespace App\Filament\Guest\Resources\EventResource\Pages;

use App\Filament\Guest\Resources\EventResource;
use App\Models\Event;
use App\Models\EventDetail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;
}
