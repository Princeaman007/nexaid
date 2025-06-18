<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipSearchServiceResource\Pages;
use App\Filament\Resources\InternshipSearchServiceResource\RelationManagers;
use App\Models\InternshipSearchService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InternshipSearchServiceResource extends Resource
{
    protected static ?string $model = InternshipSearchService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('package_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('package_slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('profile_analysis')
                    ->required(),
                Forms\Components\TextInput::make('application_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('cv_optimization')
                    ->required(),
                Forms\Components\Toggle::make('cover_letter_optimization')
                    ->required(),
                Forms\Components\Toggle::make('unlimited_followup')
                    ->required(),
                Forms\Components\Toggle::make('direct_company_connection')
                    ->required(),
                Forms\Components\Toggle::make('personalized_advisor')
                    ->required(),
                Forms\Components\Toggle::make('has_guarantee')
                    ->required(),
                Forms\Components\TextInput::make('guarantee_duration_months')
                    ->numeric(),
                Forms\Components\TextInput::make('guarantee_refund_percentage')
                    ->numeric(),
                Forms\Components\Textarea::make('guarantee_conditions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('supported_sectors'),
                Forms\Components\TextInput::make('supported_languages'),
                Forms\Components\TextInput::make('covered_countries'),
                Forms\Components\TextInput::make('partner_companies_count')
                    ->numeric(),
                Forms\Components\TextInput::make('success_rate_percentage')
                    ->numeric(),
                Forms\Components\TextInput::make('average_placement_days')
                    ->numeric(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('profile_analysis')
                    ->boolean(),
                Tables\Columns\TextColumn::make('application_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('cv_optimization')
                    ->boolean(),
                Tables\Columns\IconColumn::make('cover_letter_optimization')
                    ->boolean(),
                Tables\Columns\IconColumn::make('unlimited_followup')
                    ->boolean(),
                Tables\Columns\IconColumn::make('direct_company_connection')
                    ->boolean(),
                Tables\Columns\IconColumn::make('personalized_advisor')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_guarantee')
                    ->boolean(),
                Tables\Columns\TextColumn::make('guarantee_duration_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guarantee_refund_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('partner_companies_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('success_rate_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_placement_days')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternshipSearchServices::route('/'),
            'create' => Pages\CreateInternshipSearchService::route('/create'),
            'edit' => Pages\EditInternshipSearchService::route('/{record}/edit'),
        ];
    }
}
