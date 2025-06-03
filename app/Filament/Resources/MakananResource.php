<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakananResource\Pages;
use App\Filament\Resources\MakananResource\RelationManagers;
use App\Models\Makanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MakananResource extends Resource
{
    protected static ?string $model = Makanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Daftar Makanan';
    protected static ?string $navigationGroup = 'Manajemen Makanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                ->label('Nama Makanan')
                ->required(),

                TextInput::make('harga')
                ->label('Harga')
                ->numeric()
                ->mask(RawJs::make('$money($input)'))
                ->stripCharacters(',')
                ->required(),

                TextInput::make('deskripsi')
                ->label('Deskripsi'),

                Select::make('mitras_id')
                ->relationship(name: 'mitras', titleAttribute: 'name')
                ->required(),

                Select::make('kategoris_id')
                ->relationship(name: 'kategoris', titleAttribute: 'nama')
                ->required(),

                FileUpload::make('gambar_makanan')
                ->label('Gambar')
                ->directory('Gambar_Makanan')
                ->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('tersedia')
                ->label('Tersedia'),

                TextColumn::make('kategoris.nama')
                ->label('Kategori')
                ->sortable(),

                TextColumn::make('nama')
                ->label('Nama Makanan')
                ->sortable()
                ->searchable(),

                TextColumn::make('harga')
                ->label('Harga')
                ->money('IDR', locale: 'id')
                ->sortable(),

                TextColumn::make('deskripsi')
                ->label('Deskripsi'),

                TextColumn::make('mitras.name')
                ->label('Mitra')
                ->sortable(),



            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMakanans::route('/'),
            'create' => Pages\CreateMakanan::route('/create'),
            'edit' => Pages\EditMakanan::route('/{record}/edit'),
        ];
    }
}
