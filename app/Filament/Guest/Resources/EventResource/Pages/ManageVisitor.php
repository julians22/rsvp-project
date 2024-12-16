<?php

namespace App\Filament\Guest\Resources\EventResource\Pages;

use App\Enums\VisitorType;
use App\Filament\Component\EventTable;
use App\Filament\Guest\Resources\EventResource;
use App\Models\Visitor;
use Filament\Actions;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageVisitor extends ManageRelatedRecords
{
    protected static string $resource = EventResource::class;

    protected static string $relationship = 'visitors';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected $userType = [];

    public static function getNavigationLabel(): string
    {
        return 'Visitor';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('name')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('business'),
                // Forms\Components\TextInput::make('company'),
                // Forms\Components\TextInput::make('phone')
                //     ->required()
                //     ->maxLength(15),
                // Forms\Components\TextInput::make('email')
                //     ->required()
                //     ->email()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('invited_by')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\Checkbox::make('is_online'),
                // Forms\Components\Checkbox::make('is_offline'),
                // Forms\Components\TextInput::make('food')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\FileUpload::make('payment')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(EventTable::ManageVisitor())
            ->filters([
                SelectFilter::make('type')
                    // ->multiple()
                    ->options(VisitorType::class)
            ])
            ->deferFilters()
            ->headerActions([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make()
                //     ->modalDescription('Are you sure you want to delete this visitor? This action cannot be undone, and all data will be lost (including payment proof).')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
