<?php

namespace App\Filament\Mitra\Resources\MakananResource\Pages;

use App\Filament\Mitra\Resources\MakananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMakanan extends EditRecord
{
    protected static string $resource = MakananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
