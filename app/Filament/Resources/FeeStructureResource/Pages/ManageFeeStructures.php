<?php

namespace App\Filament\Resources\FeeStructureResource\Pages;

use App\Filament\Resources\FeeStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeeStructures extends ManageRecords
{
    protected static string $resource = FeeStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
