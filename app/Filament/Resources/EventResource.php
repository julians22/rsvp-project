<?php

namespace App\Filament\Resources;

use App\Enums\VisitorType;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\Pages\ManageVisitor;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                SpatieMediaLibraryFileUpload::make('banner')
                    ->collection('banner')
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label(__('Name')),

                CheckboxList::make('session')
                    ->options([
                        'offline' => 'Offline',
                        'online' => 'Online',
                    ])
                    ->required(),

                Toggle::make('checkable'),

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

                Group::make()
                    ->columnSpanFull()
                    ->relationship(
                        'detail'
                    )
                    ->schema(
                        [
                            Grid::make(12)
                                ->schema([
                                    Section::make('Online Event Detail')
                                        ->columnSpan(6)
                                        ->schema([
                                            DateTimePicker::make('online_time')
                                                ->timezone('Asia/Jakarta')
                                                ->displayFormat('H:i')
                                                ->default('09:00')
                                                ->date(false)
                                                ->seconds(false)
                                                ->columnSpanFull(),
                                            TextInput::make('online_link')
                                                ->label(__('Online Link'))
                                                ->required()
                                                ->columnSpanFull(),
                                            TextInput::make('online_password')
                                                ->label(__('Online Password'))
                                                ->required()
                                                ->columnSpanFull(),
                                        ]),

                                    Section::make('Offline Event Detail')
                                        ->columnSpan(6)
                                        ->schema([
                                            DateTimePicker::make('offline_time')
                                                ->label(__('Offline Time'))
                                                ->timezone('Asia/Jakarta')
                                                ->displayFormat('H:i')
                                                ->default('14:00')
                                                ->date(false)
                                                ->seconds(false)
                                                ->columnSpanFull(),
                                            RichEditor::make('offline_address')
                                                ->label(__('Offline Address'))
                                                ->required()
                                                ->columnSpanFull(),
                                            TextInput::make('offline_location')
                                                ->label(__('Offline Location URL'))
                                                ->required()
                                                ->url()
                                                ->columnSpanFull(),

                                            // Toggle::make('is_offline_food_free'),

                                            Toggle::make('override_offline_food_price_text')
                                                ->live(),

                                            TextInput::make('offline_food_price_text')
                                                ->label(__('Offline Food Price Text'))
                                                ->hidden(fn(Get $get): bool =>  !$get('override_offline_food_price_text'))
                                                ->required(fn(Get $get): bool => $get('override_offline_food_price_text')),

                                            TextInput::make('offline_food_price')
                                                ->label(__('Offline Food Price'))
                                                ->hidden(fn(Get $get): bool =>  $get('override_offline_food_price_text'))
                                                ->required(fn(Get $get): bool => !$get('override_offline_food_price_text'))
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->columnSpanFull(),

                                            Repeater::make('offline_foods')
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
                                ]),
                            Section::make('Event Detail Override')
                                ->schema([
                                    Select::make('event_type')
                                        ->options([
                                            'soft launch' => 'SOFT LAUNCH',
                                            'grand launch' => 'GRAND LAUNCH',
                                        ])
                                        ->default('soft launch'),

                                    Toggle::make('override_online_visitor_type')
                                        ->live(),
                                    Select::make('online_visitor_type_list')
                                        ->multiple()
                                        ->options(
                                            VisitorType::class
                                        )
                                        ->hidden(fn(Get $get): bool =>  !$get('override_online_visitor_type'))
                                        ->required(fn(Get $get): bool => $get('override_online_visitor_type'))
                                        ->hintActions(
                                            [
                                                fn(Select $component) => Action::make('select all')
                                                    ->action(
                                                        fn() => $component->state(array_column(VisitorType::cases(), 'value'))
                                                    ),
                                                fn(Select $component) => Action::make('deselect all')
                                                    ->action(
                                                        fn() => $component->state([])
                                                    )
                                            ]
                                        ),

                                    Toggle::make('override_offline_visitor_type')
                                        ->live(),
                                    Select::make('offline_visitor_type_list')
                                        ->multiple()
                                        ->options(
                                            VisitorType::class
                                        )
                                        ->hidden(fn(Get $get): bool =>  !$get('override_offline_visitor_type'))
                                        ->required(fn(Get $get): bool => $get('override_offline_visitor_type'))
                                        ->hintActions(
                                            [
                                                fn(Select $component) => Action::make('select all')
                                                    ->action(
                                                        fn() => $component->state(array_column(VisitorType::cases(), 'value'))
                                                    ),

                                                fn(Select $component) => Action::make('deselect all')
                                                    ->action(
                                                        fn() => $component->state([])
                                                    )
                                            ]
                                        ),

                                    Toggle::make('override_description_1')
                                        ->live(),
                                    RichEditor::make('description_1')
                                        ->hidden(fn(Get $get): bool =>  !$get('override_description_1'))
                                        ->required(fn(Get $get): bool => $get('override_description_1'))
                                        ->columnSpanFull(),

                                    Toggle::make('override_description_2')
                                        ->live(),
                                    RichEditor::make('description_2')
                                        ->hidden(fn(Get $get): bool =>  !$get('override_description_2'))
                                        ->required(fn(Get $get): bool => $get('override_description_2'))
                                        ->columnSpanFull(),

                                    Toggle::make('override_video')
                                        ->live(),
                                    SpatieMediaLibraryFileUpload::make('video')
                                        ->hidden(fn(Get $get): bool =>  !$get('override_video'))
                                        ->required(fn(Get $get): bool => $get('override_video'))
                                        ->collection('video')
                                        ->acceptedFileTypes(['video/*']),
                                ])
                        ],

                    )
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
                Tables\Actions\Action::make('visitors')
                    ->label('Manage Visitors')
                    ->icon('heroicon-o-user-group')
                    ->url(fn(Event $record) => ManageVisitor::getUrl(['record' => $record->id])),
                Tables\Actions\EditAction::make()
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
            'visitors' => Pages\ManageVisitor::route('/{record}/visitors')
        ];
    }


    protected static function startDateSelected(Set $set, $date)
    {
        $date = Carbon::parse($date);

        $set('registration_date', $date->subDays(1)->format('Y-m-d'));
    }
}
