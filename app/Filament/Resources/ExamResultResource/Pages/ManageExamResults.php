<?php

namespace App\Filament\Resources\ExamResultResource\Pages;

use App\Filament\Resources\ExamResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageExamResults extends ManageRecords
{
    protected static string $resource = ExamResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
