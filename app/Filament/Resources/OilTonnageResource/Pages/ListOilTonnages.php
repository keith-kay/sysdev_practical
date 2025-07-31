<?php

namespace App\Filament\Resources\OilTonnageResource\Pages;

use App\Filament\Resources\OilTonnageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOilTonnages extends ListRecords
{
    protected static string $resource = OilTonnageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
