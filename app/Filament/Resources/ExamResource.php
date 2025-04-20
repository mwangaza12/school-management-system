<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Examinations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('subject_id')
                ->relationship('subject','id')
                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id}.  {$record->subject_code}")
                ->required(),
                TextInput::make('exam_name'),
                Select::make('form')
                ->options([
                    'Form 1' => 'Form 1',
                    'Form 2' => 'Form 2',
                    'Form 3' => 'Form 3',
                    'Form 4' => 'Form 4',
                ]),
                Select::make('term')
                ->options([
                    'Term 1' => 'Term 1',
                    'Term 2' => 'Term 2',
                    'Term 3' => 'Term 3',
                ]),
                DatePicker::make('year')
                ->native(false)
                ->displayFormat('Y')
                ->format('Y')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject.subject_code')
                    ->label('Subject')
                    ->formatStateUsing(fn ($record) => "{$record->subject->subject_code}"),
                TextColumn::make('form'),
                TextColumn::make('exam_name')
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
            'index' => Pages\ManageExams::route('/'),
        ];
    }
}
