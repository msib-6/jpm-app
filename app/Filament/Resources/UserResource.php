<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')->email()
                            ->required(),
                        Select::make('role')
                            ->options([
                                'Manager' => 'Manager',
                                'Storage' => 'Storage',
                                'Line1' => 'Line 1',
                                'Line2' => 'Line 2',
                                'Line3' => 'Line 3',
                                'Line4' => 'Line 4',
                                'Line5' => 'Line 5',
                                'Line6' => 'Line 6',
                                'Line7' => 'Line 7',
                                'Line8' => 'Line 8',
                                'Line9' => 'Line 9',
                                'Line8a' => 'Line 8A',
                                'Line8b' => 'Line 8B',
                                'Line10' => 'Line 10',
                                'Line11' => 'Line 11',
                                'Line12' => 'Line 12',
                                'Line13' => 'Line 13',
                                'Line14' => 'Line 14',
                            ])
                            ->required()
                            ->native(false),
                        CheckboxList::make('email_role')
                            ->options([
                                'Line1' => 'Line 1',
                                'Line2' => 'Line 2',
                                'Line3' => 'Line 3',
                                'Line4' => 'Line 4',
                                'Line5' => 'Line 5',
                                'Line6' => 'Line 6',
                                'Line7' => 'Line 7',
                                'Line8' => 'Line 8',
                                'Line9' => 'Line 9',
                                'Line8a' => 'Line 8A',
                                'Line8b' => 'Line 8B',
                                'Line10' => 'Line 10',
                                'Line11' => 'Line 11',
                                'Line12' => 'Line 12',
                                'Line13' => 'Line 13',
                                'Line14' => 'Line 14',
                            ])
                            ->columns(2)
                            ->bulkToggleable(),
                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                TextColumn::make('role')
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('email_role')
                    ->sortable()
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->badge()
                    ->color('primary')
                    ->separator(',')
                    ->expandableLimitedList()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->multiple()
                    ->options([
                        'admin' => 'Admin',
                        'Manager' => 'Manager',
                        'Storage' => 'Storage',
                        'Line1' => 'Line 1',
                        'Line2' => 'Line 2',
                        'Line3' => 'Line 3',
                        'Line4' => 'Line 4',
                        'Line5' => 'Line 5',
                        'Line6' => 'Line 6',
                        'Line7' => 'Line 7',
                        'Line8' => 'Line 8',
                        'Line9' => 'Line 9',
                        'Line8a' => 'Line 8A',
                        'Line8b' => 'Line 8B',
                        'Line10' => 'Line 10',
                        'Line11' => 'Line 11',
                        'Line12' => 'Line 12',
                        'Line13' => 'Line 13',
                        'Line14' => 'Line 14',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->deferFilters()
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
