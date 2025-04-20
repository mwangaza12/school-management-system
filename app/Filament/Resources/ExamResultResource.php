<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResultResource\Pages;
use App\Models\Exam;
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
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Examinations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Select::make('form_id')
                        ->relationship('form', 'year')
                        ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->year} {$record->stream->name}")
                        ->preload()
                        ->required()
                        ->live()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => 
                            $set('exam_results', Student::where('form_id', $state)
                                ->get()
                                ->map(fn ($student) => [
                                    'student_id' => $student->id,
                                    'student_name' => $student->first_name . ' ' . $student->last_name,
                                    'marks_obtained' => null
                                ])
                                ->toArray()
                            )
                        ),

                        Select::make('exam_id')
                        ->label('Exam')
                        ->options(Exam::pluck('exam_name', 'id'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, $get, $set) => 
                            $set('exam_results', collect($get('exam_results'))
                                ->map(fn ($item) => [
                                    ...$item,
                                    'exam_id' => $state,
                                    'exam_name' => Exam::find($state)?->exam_name,
                                ])
                                ->toArray()
                            )
                        )
                ]),
                

                Repeater::make('exam_results')
                    ->label('Exam Marks')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Hidden::make('student_id')
                                ->dehydrated(true),
                                
                                TextInput::make('student_name')
                                    ->label('Student Name')
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('exam_name')
                                ->label('Exam')
                                ->disabled(),

                                Hidden::make('exam_id')
                                ->dehydrated(true),

                                TextInput::make('marks_obtained')
                                    ->label('Marks')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->required(),
                            ]),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->addable(false)
                    ->reactive(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name')
                ->label('Student Name')
                ->getStateUsing(fn ($record) => $record->student?->first_name . ' ' . $record->student?->last_name)
                ->searchable(query: function ($query, $search) {
                    $query->whereHas('student', function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                    });
                }),

                TextColumn::make('exam_id')
                ->label('Exam name')
                ->formatStateUsing(fn($record) =>                   $record->exam->exam_name),
                TextColumn::make('marks_obtained')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->modalHeading('Edit Exam Result')
                ->modalSubmitActionLabel('Save Changes')
                ->form([
                    TextInput::make('marks_obtained')
                        ->label('Marks')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->required(),
        ]),
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
            'create' => Pages\CreateExamResult::route('/create'),
        ];
    }
}
