<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data): Model {
                    $eventData = [
                        'name' => $data['name'],
                        'start_date' => $data['start_date'],
                        'registration_date' => $data['registration_date'],
                    ];

                    $event = static::getModel()::create($eventData);

                    $eventDetailData = [
                        'event_id' => $event->id,
                        'online_link' => $data['event_detail']['online_link'],
                        'online_password' => $data['event_detail']['online_password'],
                        'online_time' => $data['event_detail']['online_time'],
                        'offline_address' => $data['event_detail']['offline_address'],
                        'offline_location' => $data['event_detail']['offline_location'],
                        'offline_food_price' => $data['event_detail']['offline_food_price'],
                        'offline_foods' => $data['event_detail']['offline_foods'],
                        'offline_time' => $data['event_detail']['offline_time'],
                    ];

                    $event->detail()->create($eventDetailData);

                    return $event;
                })
        ];
    }
}
