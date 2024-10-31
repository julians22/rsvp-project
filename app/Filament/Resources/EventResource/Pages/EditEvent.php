<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Event $record) {
                    if ($record->detail !== null) {
                        $record->detail->delete();
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $model = static::getModel();

        $record = $model::query()->with('detail')->find($data['id']);

        if ($record->detail === null) {
            $data['event_detail'] = [];
        }else{
            $data['event_detail'] = $record->detail->toArray();
        }

        return $data;
    }
}
