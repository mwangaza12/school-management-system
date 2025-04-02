<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeStructureResource\Pages;
use App\Filament\Resources\FeeStructureResource\RelationManagers;
use App\Models\FeeStructure;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class FeeStructureResource extends Resource
{
    protected static ?string $model = FeeStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Financials';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('term')
                ->options([
                    'Term 1' => 'Term 1',
                    'Term 2' => 'Term 2',
                    'Term 3' => 'Term 3'
                ])
                ->required(),
                TextInput::make('amount')->numeric()->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('amount')->prefix('ksh. ')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                
            ])
            ->headerActions([
                Action::make('Term 1')
                    ->url(fn () => route('fee-structure.previewByTerm', ['term' => 'Term 1']))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary'),
            
                Action::make('Term 2')
                    ->url(fn () => route('fee-structure.previewByTerm', ['term' => 'Term 2']))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success'),
            
                Action::make('Term 3')
                    ->url(fn () => route('fee-structure.previewByTerm', ['term' => 'Term 3']))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultGroup('term');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeeStructures::route('/'),
        ];
    }
}
