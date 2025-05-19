<?php

namespace App\Filament\Resources;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Tabs;
use App\Models\Internship;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InternshipResource\Pages\ListInternships;
use App\Filament\Resources\InternshipResource\Pages\CreateInternship;
use App\Filament\Resources\InternshipResource\Pages\EditInternship;



class InternshipResource extends Resource
{
    protected static ?string $model = Internship::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
{
    return $form->schema([
        Tabs::make('Traductions')
            ->tabs([
                Tabs\Tab::make('Français')->schema([
                    TextInput::make('title.fr')->required()->label('Titre (français)'),
                    RichEditor::make('description.fr')->required()->label('Description (français)'),
                ]),
                Tabs\Tab::make('English')->schema([
                    TextInput::make('title.en')->required()->label('Title (English)'),
                    RichEditor::make('description.en')->required()->label('Description (English)'),
                ]),
            ]),
        TextInput::make('slug')->required(),
        TextInput::make('location'),
        Select::make('category_id')
    ->relationship('category', 'name->' . app()->getLocale())
    ->label('Catégorie')
    ->required(),
        TextInput::make('company_name'),
        FileUpload::make('image'),
        Toggle::make('is_active')->default(true),
    ]);
}

    

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('title.' . app()->getLocale())
                ->searchable()
                ->label('Titre / Title'),
            TextColumn::make('category.name')
                ->label('Catégorie'),
            TextColumn::make('company_name')
                ->label('Entreprise'),
            BooleanColumn::make('is_active')
                ->label('Actif'),
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
            'index' => ListInternships::route('/'),
            'create' => CreateInternship::route('/create'),
            'edit' => EditInternship::route('/{record}/edit'),
        ];
    }
    
}
