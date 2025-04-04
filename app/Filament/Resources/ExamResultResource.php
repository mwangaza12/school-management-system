<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResultResource\Pages;
use App\Models\ExamResult;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Examinations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('term')
                ->label('Term')
                ->options([
                    'Term 1' => 'Term 1',
                    'Term 2' => 'Term 2',
                    'Term 3' => 'Term 3',
                ])
                ->required()
                ->native(false),

                Select::make('form_id')
                ->relationship('form', 'year')
                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->year} {$record->stream->name}")
                ->preload()
                ->required()
                ->live()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => 
                    $set('exam_marks', Student::where('form_id', $state)
                        ->get()
                        ->map(fn ($student) => [
                            'student_id' => $student->id,
                            'student_name' => $student->first_name . ' ' . $student->last_name,
                            'marks_obtained' => null
                        ])
                        ->toArray()
                    )
                ),

                Repeater::make('exam_marks')
                    ->label('Exam Marks')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('student_name')
                                    ->label('Student Name')
                                    ->disabled(), // Automatically filled with student name

                                TextInput::make('student_id')
                                    ->hidden(), // Store student ID but keep it hidden

                                TextInput::make('marks_obtained')
                                    ->label('Marks')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->required(),
                            ]),
                    ])
                    ->defaultItems(0) // Initially empty
                    ->columnSpanFull()
                    ->addActionLabel('Add Student Mark')
                    ->reactive(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageExamResults::route('/'),
        ];
    }
}
