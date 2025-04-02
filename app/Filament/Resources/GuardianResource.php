<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuardianResource\Pages;
use App\Filament\Resources\GuardianResource\RelationManagers;
use App\Models\Guardian;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use function Laravel\Prompts\search;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Admissions & Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('phone_number')->numeric()->required(),
                TextInput::make('email')->email()->required(),
                Select::make('relationship')->options([
                    'Father'=> 'Father',
                    'Mother' => 'Mother',
                    'Guardian' => 'Guardian'
                ])->required(),
                TextInput::make('address')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('phone_number'),
                TextColumn::make('email')
            ])
            ->filters([
                
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
            'index' => Pages\ManageGuardians::route('/'),
        ];
    }
}
