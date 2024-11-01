<?php

namespace App\Filament\Exports;

use App\Models\EventVisitor;
use App\Models\Visitor;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class EventVisitorExporter extends Exporter
{
    protected static ?string $model = Visitor::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('business'),
            ExportColumn::make('company'),
            ExportColumn::make('phone'),
            ExportColumn::make('email'),
            ExportColumn::make('invited_by'),
            ExportColumn::make('is_online')
                ->label('Online'),
            ExportColumn::make('is_offline')
                ->label('Offline'),
            ExportColumn::make('meta')

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your event visitor export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
