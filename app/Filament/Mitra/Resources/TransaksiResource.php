<?php

namespace App\Filament\Mitra\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Transaksi;
use App\Filament\Mitra\Resources\TransaksiResource\RelationManagers;
use App\Filament\Mitra\Resources\TransaksiResource\Pages;

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
                TextColumn::make('total_harga')
                ->label('Harga')
                ->money('IDR'),
                SelectColumn::make('status')
                ->options(function ($record) {
                    // Kalau status sudah 'Selesai', tampilkan semua opsi termasuk 'Selesai'
                    if ($record->status === 'Selesai') {
                        return [
                            'Proses' => 'Proses',
                            'Siap ambil' => 'Siap ambil',
                            'Selesai' => 'Selesai',
                        ];
                    }

                    // Kalau status belum 'Selesai', jangan tampilkan opsi 'Selesai'
                    return [
                        'Proses' => 'Proses',
                        'Siap ambil' => 'Siap ambil',
                    ];
                })
                ->disabled(fn ($record) => $record->status === 'Selesai')

            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

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
            // 'create' => Pages\CreateTransaksi::route('/create'),
            // 'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('mitra_id', auth()->id())
            ->where('status_pembayaran', 'sudah dibayar')
            ->orderByRaw("CASE status WHEN 'Proses' THEN 1 WHEN 'Siap ambil' THEN 2 ELSE 3 END")
            ->orderByDesc('created_at');
    }
}
