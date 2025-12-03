<?php

namespace App\Filament\Resources\FareResource\Pages;

use App\Filament\Resources\FareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFare extends EditRecord
{
    protected static string $resource = FareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
