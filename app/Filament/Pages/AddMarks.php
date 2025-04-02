<?php

namespace App\Filament\Pages;

use App\Models\ExamResult;
use App\Models\Form;
use App\Models\Student;
use App\Models\Subject;
use Filament\Pages\Page;
use Livewire\Component;

class AddMarks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Add Student Marks';
    protected static ?string $title = 'Add Student Marks';

    protected static string $view = 'filament.pages.add-marks';

    public $selectedForm = null;
    public $selectedSubject = null;
    public $students = [];
    public $marks_obtained = [];

    public function mount()
    {
        // Initialize the component
        $this->students = collect();
    }

    public function updatedSelectedForm()
    {
        // Reset marks when form changes
        $this->marks_obtained = [];
        $this->loadStudents();
    }

    public function updatedSelectedSubject()
    {
        // Reset marks when subject changes
        $this->marks_obtained = [];
        $this->loadStudents();
    }

    private function loadStudents()
    {
        if ($this->selectedForm && $this->selectedSubject) {
            // Load students from the selected form and convert to Collection
            $this->students = Student::where('form_id', $this->selectedForm)->get();
            
            // Pre-populate with existing marks if available
            foreach ($this->students as $student) {
                $existingMark = ExamResult::where('student_id', $student->id)
                    ->where('subject_id', $this->selectedSubject)
                    ->first();
                
                if ($existingMark) {
                    $this->marks_obtained[$student->id] = $existingMark->marks_obtained;
                }
            }
            
        } else {
            $this->students = collect();
        }
    }

    public function saveMarks()
{
    foreach ($this->marks_obtained as $studentId => $mark) {
        // First, check if a record already exists with these exact criteria
        $existingRecord = ExamResult::where('student_id', $studentId)
            ->where('subject_id', $this->selectedSubject)
            ->where('form_id', $this->selectedForm)
            ->first();
            
        if ($existingRecord) {
            // Update existing record
            $existingRecord->marks_obtained = $mark;
            $existingRecord->save();
        } else {
            // Create new record
            ExamResult::create([
                'student_id' => $studentId,
                'subject_id' => $this->selectedSubject,
                'marks_obtained' => $mark,
                'form_id' => $this->selectedForm,
            ]);
        }
    }

    $this->dispatch('notify', [
        'type' => 'success',
        'message' => 'Marks saved successfully!'
    ]);
}
}