<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Penjemputan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn\TextColumnSize;

class LandingPage extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function censorString($inputString)
    {
        $words = explode(' ', $inputString);
        $limit = 3;

        foreach ($words as &$word) {
            if (strlen($word) >= ($limit + 1)) {
                $censoredPart = str_repeat('*', strlen($word) - $limit);
                $word = substr_replace($word, $censoredPart, $limit);
            }
        }

        return implode(' ', $words);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Penjemputan::query()->whereDate('created_at', Carbon::today()))
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('kartu.ortu.siswa.nama')
                            ->sortable()->formatStateUsing(fn ($state) => $this->censorString($state))
                            ->searchable()->weight(FontWeight::Bold)->size(TextColumnSize::Large),
                        TextColumn::make('kartu.ortu.name')
                            ->formatStateUsing(fn ($state) => 'Orang Tua: ' . $this->censorString($state))
                            ->label('Orang Tua')
                            ->sortable()->searchable(),
                    ]),
                    Stack::make([
                        TextColumn::make('kartu.ortu.siswa.unit.nama')->badge(),
                        TextColumn::make('tanggal')
                            ->sortable(),
                        TextColumn::make('jam')
                            ->sortable(),
                    ]),
                    Stack::make([
                        ImageColumn::make('screenshoot')
                            ->searchable()->height(90)->width(160)
                            ->url(fn ($state) => $state, true),
                        TextColumn::make('created_at')
                            ->dateTime()
                            ->size(TextColumnSize::ExtraSmall),
                    ]),
                ]),
            ])
            ->filters([
                //
            ])
            ->recordUrl(null)
            ->poll('10s')
            ->striped()
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.landing-page');
    }
}
