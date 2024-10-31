<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
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
            ->schema([

                TextInput::make('name')
                    ->label(__('Name')),
                Section::make(__('Event Date'))
                    ->description('Please fill in the event date.')
                    ->columns(12)
                    ->schema([
                        DatePicker::make('start_date')
                            ->label(__('Start Date'))
                            ->timezone('Asia/Jakarta')
                            ->columnSpan(6)
                            ->live()
                            ->afterStateUpdated(
                                fn(Set $set, ?string $state) => self::startDateSelected($set, $state)
                            )
                            ->required(),
                        DatePicker::make('registration_date')
                            ->label(__('Registration Date'))
                            ->timezone('Asia/Jakarta')
                            ->columnSpan(6)
                            ->required(),
                    ]),

                Grid::make(12)
                    ->schema([
                        Section::make('Online Event Detail')
                            ->columnSpan(6)
                            ->schema([
                                DateTimePicker::make('event_detail.online_time')
                                    ->timezone('Asia/Jakarta')
                                    ->displayFormat('H:i')
                                    ->default('09:00')
                                    ->date(false)
                                    ->seconds(false)
                                    ->columnSpanFull(),
                                TextInput::make('event_detail.online_link')
                                    ->label(__('Online Link'))
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('event_detail.online_password')
                                    ->label(__('Online Password'))
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Offline Event Detail')
                            ->columnSpan(6)
                            ->schema([
                                DateTimePicker::make('event_detail.offline_time')
                                    ->label(__('Offline Time'))
                                    ->timezone('Asia/Jakarta')
                                    ->displayFormat('H:i')
                                    ->default('14:00')
                                    ->date(false)
                                    ->seconds(false)
                                    ->columnSpanFull(),
                                RichEditor::make('event_detail.offline_address')
                                    ->label(__('Offline Address'))
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('event_detail.offline_location')
                                    ->label(__('Offline Location URL'))
                                    ->required()
                                    ->url()
                                    ->columnSpanFull(),
                                TextInput::make('event_detail.offline_food_price')
                                    ->label(__('Offline Food Price'))
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->columnSpanFull(),
                                Repeater::make('event_detail.offline_foods')
                                    ->label(__('Foods Items'))
                                    ->defaultItems(3)
                                    ->columnSpanFull()
                                    ->schema([
                                        TextInput::make('food')
                                            ->label(__('Food'))
                                            ->required()
                                            ->columnSpan(6),
                                        TextInput::make('drink')
                                            ->label(__('Drink'))
                                            ->required()
                                            ->columnSpan(6),
                                    ]),
                            ]),
                    ])
            ]);
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }


    protected static function startDateSelected(Set $set, $date)
    {
        $date = Carbon::parse($date);

        $set('registration_date', $date->subDays(1)->format('Y-m-d'));
    }
}
