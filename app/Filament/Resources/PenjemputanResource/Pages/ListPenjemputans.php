<?php

namespace App\Filament\Resources\PenjemputanResource\Pages;

use Filament\Actions;
use Livewire\Attributes\On;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PenjemputanResource;
use App\Filament\Resources\PenjemputanResource\Widgets\CreatePenjemputanWidget;
use Closure;

class ListPenjemputans extends ListRecords
{
    protected static string $resource = PenjemputanResource::class;

    #[On('contact-created')] 
    public function refresh() {}
    
    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CreatePenjemputanWidget::class,
        ];
    }
    
}
