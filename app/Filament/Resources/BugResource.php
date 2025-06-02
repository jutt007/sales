<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BugResource\Pages;
use App\Models\Bug;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BugResource extends Resource
{
    protected static ?string $model = Bug::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\Toggle::make('status')->inline(false)->label('Is Outdoor'),
                Forms\Components\FileUpload::make('image')->image()->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\ToggleColumn::make('status')->sortable()->label('Is Outdoor'),
                Tables\Columns\ImageColumn::make('image')->square(),
                Tables\Columns\TextColumn::make('created_at')->date('d-m-Y')->sortable()
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\Filter::make('status')
                    ->label('Is Outdoor')
                    ->query(fn (Builder $query): Builder => $query->where('status', true))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListBugs::route('/'),
            'create' => Pages\CreateBug::route('/create'),
            'edit' => Pages\EditBug::route('/{record}/edit'),
        ];
    }
}
