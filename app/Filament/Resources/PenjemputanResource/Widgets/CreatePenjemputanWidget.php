<?php

namespace App\Filament\Resources\PenjemputanResource\Widgets;

use Filament\Forms\Form;
use App\Models\Penjemputan;
use Filament\Widgets\Widget;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\CctvCaptureController;
use App\Rules\UniqueForToday;
use Filament\Forms\Concerns\InteractsWithForms;

class CreatePenjemputanWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.penjemputan-resource.widgets.create-penjemputan-widget';

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('kartu_id')
                ->autofocus()->label('Kartu Penjemput')
                ->validationMessages([
                    'exists' => 'Kartu tidak terdaftar',
                ])
                ->exists('kartus', 'id')
                ->rules([
                    new UniqueForToday,
                ]),
            Hidden::make('tanggal')
                ->default(now())
                ->dehydrateStateUsing(fn() => now()),
            Hidden::make('jam')
                ->default(now())
                ->dehydrateStateUsing(fn() => now()),
            Hidden::make('screenshoot')
                ->dehydrateStateUsing(function () {
                    $capture = new CctvCaptureController();
                    return $capture->captureImage();
                }),
        ])->statePath('data');
    }

    public function create(): void
    {
        Penjemputan::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
    }

    protected function onValidationError(ValidationException $exception): void
    {
        $this->data['kartu_id'] = null; // Reset hanya kartu_id
        $this->form->fill($this->data); // Pastikan form di-refresh
        Notification::make('errorval')
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
}
