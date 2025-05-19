<?php

namespace App\Filament\Resources;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use Filament\Forms\Components\Tabs;





class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Traductions')
                ->tabs([
                    Tabs\Tab::make('Français')->schema([
                        TextInput::make('name.fr')
                            ->required()
                            ->label('Nom (français)'),
                    ]),
                    Tabs\Tab::make('English')->schema([
                        TextInput::make('name.en')
                            ->required()
                            ->label('Name (English)'),
                    ]),
                ]),
            TextInput::make('slug')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name.' . app()->getLocale())
                    ->label('Nom / Name'),
                TextColumn::make('slug'),
                TextColumn::make('created_at')->dateTime()
                    ->label('Créé le'),
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
    
}
