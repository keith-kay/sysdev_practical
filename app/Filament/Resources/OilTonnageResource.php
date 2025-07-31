<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OilTonnageResource\Pages;
use App\Filament\Resources\OilTonnageResource\RelationManagers;
use App\Models\OilTonnage;
use App\Models\vcf;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OilTonnageResource extends Resource
{
    protected static ?string $model = OilTonnage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Oil Tonnage Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('volume')
                            ->label('Volume (litres)')
                            ->numeric()
                            ->required(),

                        TextInput::make('density')
                            ->label('Density (kg/m³)')
                            ->numeric()
                            ->required(),

                        TextInput::make('temperature')
                            ->label('Temperature (°C)')
                            ->numeric()
                            ->required(),

                        TextInput::make('vcf')
                            ->label('Volume Correction Factor')
                            ->numeric()
                            ->readonly()
                            ->readOnly(),

                        TextInput::make('tonnage')
                            ->label('Calculated Tonnage (MT)')
                            ->numeric()
                            ->readonly()
                            ->dehydrated(),
                    Actions::make([
                        Actions\Action::make('calculate')
                            ->label('Calculate Tonnage')
                            ->action('calculateTonnage')
                            ->color('success')
                            ->icon('heroicon-m-calculator')
                            ->extraAttributes([
                                'style' => 'width: 100%; margin-top: 1.75rem;',
                            ]),
                    ]),
                    ]),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('volume')
                    ->label('Volume')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('density')
                    ->label('Density')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('temperature')
                    ->label('Temperature')
                    ->sortable(),
                TextColumn::make('vcf') 
                    ->label('Volume Correction Factor')
                    ->sortable(),
                TextColumn::make('tonnage') 
                    ->label('Tonnage')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsSection::make('Tonnage Details')
                    ->schema([
                        TextEntry::make('volume')
                            ->label('Volume'),
                        TextEntry::make('density')
                            ->label('Density'),
                        TextEntry::make('temperature')
                            ->label('Temperature'),
                        TextEntry::make('vcf')
                            ->label('Volume Correctional Factor'),
                        TextEntry::make('tonnage')
                            ->label('Tonnage')

                    ])->columns(2),
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
            'index' => Pages\ListOilTonnages::route('/'),
            'create' => Pages\CreateOilTonnage::route('/create'),
            'edit' => Pages\EditOilTonnage::route('/{record}/edit'),
            
        ];
    }
}
