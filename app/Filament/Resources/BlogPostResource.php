<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Traductions')
                ->tabs([
                    Tabs\Tab::make('Français')->schema([
                        TextInput::make('title.fr')
                            ->required()
                            ->label('Titre (français)'),
    
                        RichEditor::make('content.fr')
                            ->required()
                            ->label('Contenu (français)'),
                    ]),
                    Tabs\Tab::make('English')->schema([
                        TextInput::make('title.en')
                            ->required()
                            ->label('Title (English)'),
    
                        RichEditor::make('content.en')
                            ->required()
                            ->label('Content (English)'),
                    ]),
                ]),
            TextInput::make('slug')
                ->required(),
            FileUpload::make('image'),
            DateTimePicker::make('published_at'),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title.' . app()->getLocale())
                    ->label('Titre / Title')
                    ->searchable(),
                BooleanColumn::make('is_active')
                    ->label('Actif'),
                TextColumn::make('published_at')
                    ->label('Date de publication')
                    ->dateTime(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
