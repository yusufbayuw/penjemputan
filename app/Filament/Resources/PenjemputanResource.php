<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Penjemputan;
use App\Rules\UniqueForToday;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use App\Http\Controllers\CctvCaptureController;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenjemputanResource\Pages;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\PenjemputanResource\RelationManagers;
use App\Filament\Resources\PenjemputanResource\Widgets\CreatePenjemputanWidget;

class PenjemputanResource extends Resource
{
    protected static ?string $model = Penjemputan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $label = null;

    protected static ?string $slug = 'penjemputan';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kartu_id')
                    ->autofocus()
                    ->rules([
                        new UniqueForToday,
                    ]),
                Forms\Components\Hidden::make('tanggal')
                    ->default(now())
                    ->dehydrateStateUsing(fn () => now()),
                Forms\Components\Hidden::make('jam')
                    ->default(now())
                    ->dehydrateStateUsing(fn () => now()),
                Forms\Components\Hidden::make('screenshoot')
                    ->dehydrateStateUsing(function (Penjemputan $record) {
                        if ($record->screenshoot) {
                            //
                        } else {
                            $capture = new CctvCaptureController();
                            return $capture->captureImage();
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Tables\Columns\TextColumn::make('kartu.ortu.siswa.nama')
                            ->sortable()->searchable()->weight(FontWeight::Bold)->size(TextColumnSize::Large),
                        Tables\Columns\TextColumn::make('kartu.ortu.name')
                            ->sortable()->searchable(),
                    ]),
                    Stack::make([
                        Tables\Columns\TextColumn::make('kartu.ortu.siswa.unit.nama')->badge(),
                        Tables\Columns\TextColumn::make('tanggal')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('jam'),
                    ]),
                    Stack::make([
                        Tables\Columns\ImageColumn::make('screenshoot')
                            ->searchable()->height(90)->width(160),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->sortable()->size(TextColumnSize::ExtraSmall)
                            ->toggleable(isToggledHiddenByDefault: true),
                    ]),
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjemputans::route('/'),
            'create' => Pages\CreatePenjemputan::route('/create'),
            'edit' => Pages\EditPenjemputan::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CreatePenjemputanWidget::class,
        ];
    }
}
