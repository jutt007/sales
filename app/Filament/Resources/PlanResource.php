<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'bi-card-checklist';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Plan Info')->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\TextInput::make('initial_fee')->numeric()->label('Initial Fee'),
                    Forms\Components\TextInput::make('discount')->numeric()->label('Discount'),
                    Forms\Components\RichEditor::make('description')
                        ->label('Plan Description')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'bulletList', 'orderedList',
                            'blockquote', 'link', 'undo', 'redo'
                        ])
                        ->columnSpanFull()
                        ->maxLength(2000),
                ])->columns(3),
                Forms\Components\Section::make('Billing Options')->schema([
                    Forms\Components\HasManyRepeater::make('prices')
                        ->relationship('prices')
                        ->schema([
                            Forms\Components\Select::make('billing_type')
                                ->options([
                                    'monthly' => 'Monthly',
                                    'quarterly' => 'Quarterly',
                                    'bi_monthly' => 'Bi-Monthly',
                                    'per_service' => 'Per Service',
                                ])
                                ->required()
                                ->distinct()->columnSpanFull(),
                            Forms\Components\TextInput::make('amount')
                                ->numeric()
                                ->required()->columnSpanFull()
                        ])
                        ->grid(3)
                    ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('initial_fee')->label('Initial Fee')->money(),
                Tables\Columns\TextColumn::make('discount')->label('Discount'),
                Tables\Columns\TextColumn::make('prices')->label('Billing Options')->formatStateUsing(function ($record){
                    return $record->prices->map(function ($price) {
                        $label = ucfirst(str_replace('_', ' ', $price->billing_type));
                        return "<div><strong>{$label}:</strong> $" . number_format($price->amount, 2) . "</div>";
                    })->implode('');
                })->html()
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
