<?php

namespace App\Filament\Component;

use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;

class EventTable
{
    static public function Event()
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
            TextColumn::make('start_date')
                ->searchable()
                ->sortable(),
            TextColumn::make('registration_date')
                ->searchable()
                ->sortable(),
            TextColumn::make('url')
                ->label('Registration URL')
                ->color(
                    function ($state) {
                        return $state === '#' ? 'gray' : 'success';
                    }
                )
                ->formatStateUsing(
                    fn($state) => $state === '#' ? 'No URL' : $state . ' (Click to copy)'
                )
                ->copyable(
                    fn(Event $record) => $record->detail !== null ? true : false
                )
                ->copyMessage('URL address copied')
                ->copyMessageDuration(1500),
        ];
    }

    static public function ManageVisitor()
    {
        return [
            TextColumn::make('type')
                ->placeholder('Type')
                ->sortable()
                ->searchable(),
            TextColumn::make('name'),
            IconColumn::make('is_online')
                ->label('Online Presence')
                ->icon(fn(string $state): string => match ($state) {
                    '1' => 'heroicon-o-check-circle',
                    '0' => 'heroicon-o-x-circle',
                    default => 'heroicon-o-x-circle',
                }),
            TextColumn::make('status'),
            IconColumn::make('is_offline')
                ->label('Offline Presence')
                ->icon(fn(string $state): string => match ($state) {
                    '1' => 'heroicon-o-check-circle',
                    '0' => 'heroicon-o-x-circle',
                    default => 'heroicon-o-x-circle',
                }),
            TextColumn::make('food')
                ->listWithLineBreaks()
                ->bulleted()
                ->label('Packaged Food'),
            TextColumn::make('invited_by'),

            TextColumn::make('business'),
            TextColumn::make('company'),
            TextColumn::make('email'),
            TextColumn::make('phone'),


            SpatieMediaLibraryImageColumn::make('Payment Proof')
                ->collection('payment_proof')
                ->checkFileExistence(false)
                ->action(
                    Action::make('show_payment_proof')
                        ->label('Payment Proof')
                        // ->action(fn (Visitor $visitor) => $visitor->payment_path_url)
                        ->modalContent(
                            fn(Visitor $visitor): View => view(
                                'filament.resources.event-resource.pages.image-modal',
                                ['image' => $visitor->getFirstMediaUrl('payment_proof')]
                            )
                        )
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->modalWidth(MaxWidth::ScreenMedium)
                )
                ->label('Payment Proof')
        ];
    }
}