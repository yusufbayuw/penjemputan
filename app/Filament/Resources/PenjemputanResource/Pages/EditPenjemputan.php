<?php

namespace App\Filament\Resources\PenjemputanResource\Pages;

use App\Filament\Resources\PenjemputanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenjemputan extends EditRecord
{
    protected static string $resource = PenjemputanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
