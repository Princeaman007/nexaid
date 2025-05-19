<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;



class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

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
    
                        Textarea::make('description.fr')
                            ->label('Description (français)'),
                    ]),
                    Tabs\Tab::make('English')->schema([
                        TextInput::make('name.en')
                            ->required()
                            ->label('Name (English)'),
    
                        Textarea::make('description.en')
                            ->label('Description (English)'),
                    ]),
                ]),
            FileUpload::make('logo'),
            TextInput::make('website_url')->label('URL du site'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.' . app()->getLocale())
                    ->searchable()
                    ->label('Nom / Name'),
                TextColumn::make('website_url')
                    ->label('Site Web'),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
