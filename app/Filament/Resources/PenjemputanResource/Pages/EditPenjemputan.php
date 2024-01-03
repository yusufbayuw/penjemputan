<?php

namespace App\Filament\Resources\PenjemputanResource\Pages;

use App\Filament\Resources\PenjemputanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenjemputan extends EditRecord
{
    protected static string $resource = PenjemputanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
