<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null) // Hanya hash jika diisi
                ->nullable()
                ->maxLength(255),
                Forms\Components\TextInput::make('api_key')->label('API Token')->disabled()->readOnly(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('posts_count')->counts('posts'),
                Tables\Columns\TextColumn::make('api_key')->label('API Token'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ;
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
