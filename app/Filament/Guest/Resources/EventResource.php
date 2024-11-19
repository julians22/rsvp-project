<?php

namespace App\Filament\Guest\Resources;

use App\Filament\Guest\Resources\EventResource\Pages;
use App\Filament\Guest\Resources\EventResource\Pages\ManageVisitor;
use App\Models\Event;
use Carbon\Carbon;

use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registration_date')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('visitors')
                    ->label('See Visitor')
                    ->icon('heroicon-o-user-group')
                    ->url(fn(Event $record) => ManageVisitor::getUrl(['record' => $record->id])),
                // Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            // 'create' => Pages\CreateEvent::route('/create'),
            // 'edit' => Pages\EditEvent::route('/{record}/edit'),
            'visitors' => Pages\ManageVisitor::route('/{record}/visitors')
        ];
    }


    protected static function startDateSelected(Set $set, $date)
    {
        $date = Carbon::parse($date);

        $set('registration_date', $date->subDays(1)->format('Y-m-d'));
    }
}
