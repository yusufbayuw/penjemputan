<?php

namespace App\Filament\Resources\KartuResource\Pages;

use Filament\Actions;
use App\Filament\Resources\KartuResource;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ListKartus extends ListRecords
{
    protected static string $resource = KartuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make('import')
                ->color("info")
                ->icon('heroicon-o-arrow-up-tray'),
            Actions\CreateAction::make(),
        ];
    }
}
