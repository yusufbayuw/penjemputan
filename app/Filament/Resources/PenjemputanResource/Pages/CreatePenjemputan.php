<?php

namespace App\Filament\Resources\PenjemputanResource\Pages;

use App\Filament\Resources\PenjemputanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenjemputan extends CreateRecord
{
    protected static string $resource = PenjemputanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
