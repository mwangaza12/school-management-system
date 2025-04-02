<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Academics';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')->schema([
                    TextInput::make('first_name')->required(),
                    TextInput::make('last_name')->required(),
                    Select::make('gender')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other'
                        ])->required(),
                    DatePicker::make('date_of_birth')->required(),
                ])
                ->columns(2),

                Section::make('Contact Details')->schema([
                    TextInput::make('phone_number')->tel(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('address'),
                ])
                ->columns(2),

                Section::make('Employment Details')->schema([
                    Select::make('subjects')
                    ->relationship('subjects', 'subject_name')
                    ->multiple()
                    ->preload()
                    ->required(),
                    DatePicker::make('employment_date')->required(),
                    Select::make('status')
                        ->options([
                            'Active' => 'Active',
                            'Retired' => 'Retired',
                            'Resigned' => 'Resigned'
                        ])->required()
                ])
                ->columns(2)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('subjects.subject_name'),
                TextColumn::make('status')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Active' => 'success',
                    'Resigned' => 'warning',
                    'Retired' => 'danger',
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
