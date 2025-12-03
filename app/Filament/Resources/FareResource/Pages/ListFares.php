<?php

namespace App\Filament\Resources\FareResource\Pages;

use App\Filament\Resources\FareResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFares extends ListRecords
{
    protected static string $resource = FareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
