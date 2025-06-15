<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Filament\Resources\LeadResource\RelationManagers;
use App\Models\Bug;
use App\Models\Lead;
use Carbon\Carbon;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-funnel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(12) // Two columns side by side
                ->schema([
                    InfoSection::make('User Info')
                        ->columns(2)
                        ->schema([
                            TextEntry::make('name')->label('Full Name'),
                            TextEntry::make('email')->label('Email'),
                            TextEntry::make('phone')->label('Phone'),
                            TextEntry::make('preferred_contact_method')->label('Preferred Contact'),
                            TextEntry::make('created_at')
                                ->label('Created')
                                ->formatStateUsing(function ($state) {
                                    return Carbon::parse($state)->diffForHumans();
                                })
                        ])->columnSpan(6),

                    InfoSection::make('Address')
                        ->schema([
                            TextEntry::make('address')->label('Address'),
                            TextEntry::make('is_commercial')
                                ->label('Commercial')
                                ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                            TextEntry::make('selected_bugs')
                                ->label('Bug Types')
                                ->formatStateUsing(function ($state) {
                                    $bugIds = explode(', ', $state);
                                    $types = \App\Models\Bug::query()->whereIn('id', $bugIds)->pluck('name');
                                    return $types->isEmpty() ? 'None' : $types->join(', ');
                                })->badge()->columnSpanFull(),
                        ])->columnSpan(6),

                    InfoSection::make('Plan Info')
                        ->columns(3)
                        ->schema([
                            TextEntry::make('plan.name')->label('Plan Name'),
                            TextEntry::make('charges_type')->label('Type'),
                            TextEntry::make('initial_fee')
                                ->label('Initial Fee')
                                ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),
                            TextEntry::make('discount')
                                ->label('Discount')
                                ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),
                            TextEntry::make('charges')
                                ->label('Service Charges')
                                ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),
                            TextEntry::make('charges')
                                ->label('Final Price')
                                ->formatStateUsing(function ($state, $record) {
                                    $fee = $record->initial_fee ?? 0;
                                    $discount = $record->discount ?? 0;
                                    $charges = $record->charges ?? 0;
                                    $final = ($fee + $charges) - $discount;
                                    return '$' . number_format($final, 2);
                                })
                        ])->columnSpan(8),
                        InfoSection::make('Appointment Details')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('appointment_date')->label('Date'),
                                TextEntry::make('appointment_time')->label('Time')
                            ])->columnSpan(4),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer')
                    ->sortable(query: function ($query, $direction) {
                        return $query->orderBy('name', $direction);
                    })
                    ->searchable(query: function ($query, $search) {
                        return $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                    })
                    ->formatStateUsing(function ($record) {
                        return "<div>{$record->name}<br>{$record->email}<br>{$record->phone}</div>";
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('address')->limit(50, '...'),
                Tables\Columns\TextColumn::make('selected_bugs')
                    ->label('Bugs')
                    ->formatStateUsing(function ($state) {
                        $state = explode(', ', $state);
                        if (!$state || !is_array($state)) return '-';
                        $bugs = Bug::whereIn('id', $state)->pluck('name')->toArray();
                        return implode(', ', $bugs);
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->sortable()
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)->diffForHumans();
                    })
            ])->defaultSort('created_at', 'DESC')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'view' => Pages\ViewLead::route('/{record}'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
