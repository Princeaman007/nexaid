<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\SubscriberResource\Pages;
use App\Filament\Resources\SubscriberResource\RelationManagers;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;


class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
{
    return $form->schema([
        Tabs::make('Traductions')
            ->tabs([
                Tabs\Tab::make('Français')->schema([
                    Textarea::make('question.fr')
                        ->required()
                        ->label('Question (français)'),
                    Textarea::make('answer.fr')
                        ->required()
                        ->label('Réponse (français)'),
                ]),
                Tabs\Tab::make('English')->schema([
                    Textarea::make('question.en')
                        ->required()
                        ->label('Question (English)'),
                    Textarea::make('answer.en')
                        ->required()
                        ->label('Answer (English)'),
                ]),
            ]),
        Toggle::make('is_active')->default(true),
    ]);
}
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->limit(50),
                BooleanColumn::make('is_active'),
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
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}
