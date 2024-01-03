<?php

namespace App\Filament\Resources\KartuResource\Pages;

use App\Filament\Resources\KartuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKartu extends EditRecord
{
    protected static string $resource = KartuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
