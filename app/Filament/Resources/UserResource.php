<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;


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
                            'Line1' => 'Line 1',
                            'Line2' => 'Line 2',
                            'Line3' => 'Line 3',
                            'Line4' => 'Line 4',
                            'Line5' => 'Line 5',
                            'Line7' => 'Line 7',
                            'Line8a' => 'Line 8A',
                            'Line8b' => 'Line 8B',
                            'Line10' => 'Line 10',
                            'Line11' => 'Line 11',
                            'Line12' => 'Line 12',
                            'Line13' => 'Line 13',
                            'Line14' => 'Line 14',
                            'Manager' => 'Manager'
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
                            'Line7' => 'Line 7',
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
                    ->searchable(),
                TextColumn::make('role')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
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
