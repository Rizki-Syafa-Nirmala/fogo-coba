<?php

namespace App\Filament\Mitra\Resources\MakananResource\Pages;

use App\Filament\Mitra\Resources\MakananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMakanan extends CreateRecord
{
    protected static string $resource = MakananResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
