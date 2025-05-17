<?php

namespace App\Filament\Mitra\Resources;

use App\Filament\Mitra\Resources\TransaksiResource\Pages;
use App\Filament\Mitra\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Pembeli'),
                TextColumn::make('makanan.nama')
                ->label('Makanan'),
                TextColumn::make('status')
                ->badge(),
                TextColumn::make('harga')
                ->label('Harga')
                ->money('IDR'),
                SelectColumn::make('status')
                ->options([
                    'Proses' => 'Proses',
                    'Siap ambil' => 'Siap ambil',
                ])
                ->disabled(fn ($record) => $record->status === 'Selesai')

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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('mitra_id', auth()->id())
            ->orderByRaw("CASE status WHEN 'Proses' THEN 1 WHEN 'Siap ambil' THEN 2 ELSE 3 END")
            ->orderByDesc('created_at');
    }
}
