<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\ValueMissionResource\Pages;
use App\Filament\Resources\ValueMissionResource\RelationManagers;
use App\Models\ValueMission;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ValueMissionResource extends Resource
{
    protected static ?string $model = ValueMission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Traductions')
                ->tabs([
                    Tabs\Tab::make('Français')->schema([
                        TextInput::make('title.fr')->required()->label('Titre (français)'),
                        Textarea::make('description.fr')->required()->label('Description (français)'),
                    ]),
                    Tabs\Tab::make('English')->schema([
                        TextInput::make('title.en')->required()->label('Title (English)'),
                        Textarea::make('description.en')->required()->label('Description (English)'),
                    ]),
                ]),
            Toggle::make('is_active')->default(true),
        ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title.' . app()->getLocale())
                    ->label('Titre / Title')
                    ->limit(50),
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
            'index' => Pages\ListValueMissions::route('/'),
            'create' => Pages\CreateValueMission::route('/create'),
            'edit' => Pages\EditValueMission::route('/{record}/edit'),
        ];
    }
}
