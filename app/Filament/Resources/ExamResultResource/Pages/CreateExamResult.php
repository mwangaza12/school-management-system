<?php

namespace App\Filament\Resources\ExamResultResource\Pages;

use App\Filament\Resources\ExamResultResource;
use App\Models\ExamResult;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateExamResult extends CreateRecord
{
    protected static string $resource = ExamResultResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        foreach ($data['exam_results'] as $markEntry) {
            ExamResult::create([
                'student_id' => $markEntry['student_id'],
                'exam_id' => $data['exam_id'],
                'marks_obtained' => $markEntry['marks_obtained'],
            ]);
        }

        return new ExamResult();
    }
   
}

