<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Models\Enrollment;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Admissions & Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')->relationship('student','first_name')
                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->first_name} {$record->last_name}"),
                Select::make('form_id')->relationship('form','id')
                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->year} {$record->stream->name}")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student Name')
                    ->formatStateUsing(fn ($record) => "{$record->student?->first_name} {$record->student?->last_name}")
                    ->sortable(),

                TextColumn::make('form_id')
                    ->label('Form')
                    ->formatStateUsing(fn ($record) => "{$record->form?->year} {$record->form?->stream?->name}")
                    ->sortable(),

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
            'index' => Pages\ManageEnrollments::route('/'),
        ];
    }
}
