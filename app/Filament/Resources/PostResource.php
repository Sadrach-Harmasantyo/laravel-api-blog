<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('content')->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('user.name')->label('Author'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
