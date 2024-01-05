<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjemputanResource\Pages;
use App\Filament\Resources\PenjemputanResource\RelationManagers;
use App\Filament\Resources\PenjemputanResource\Widgets\CreatePenjemputanWidget;
use App\Http\Controllers\CctvCaptureController;
use App\Models\Penjemputan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Forms\Components\TextInput::make('kartu_id')->autofocus(),
                Forms\Components\Hidden::make('tanggal')
                    ->default(now())
                    ->dehydrateStateUsing(fn () => now()),
                Forms\Components\Hidden::make('jam')
                    ->default(now())
                    ->dehydrateStateUsing(fn () => now()),
                Forms\Components\Hidden::make('screenshoot')
                    ->default(now())
                    ->dehydrateStateUsing(function () {
                        $capture = new CctvCaptureController();
                        return $capture->captureImage();
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
                ])->from('lg'),
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
