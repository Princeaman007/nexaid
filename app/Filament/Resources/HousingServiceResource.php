<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HousingServiceResource\Pages;
use App\Filament\Resources\HousingServiceResource\RelationManagers;
use App\Models\HousingService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HousingServiceResource extends Resource
{
    protected static ?string $model = HousingService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('housing_type')
                    ->required(),
                Forms\Components\TextInput::make('housing_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('housing_slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('detailed_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('starting_price_monthly')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('deposit_amount')
                    ->numeric(),
                Forms\Components\TextInput::make('agency_fees')
                    ->numeric(),
                Forms\Components\TextInput::make('additional_costs'),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('district')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->numeric(),
                Forms\Components\TextInput::make('room_count')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('bathroom_count')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('surface_area_sqm')
                    ->numeric(),
                Forms\Components\Toggle::make('furnished')
                    ->required(),
                Forms\Components\TextInput::make('max_occupants')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\Toggle::make('suitable_for_couples')
                    ->required(),
                Forms\Components\TextInput::make('amenities'),
                Forms\Components\TextInput::make('shared_facilities'),
                Forms\Components\Toggle::make('utilities_included')
                    ->required(),
                Forms\Components\TextInput::make('included_utilities'),
                Forms\Components\Toggle::make('cleaning_service')
                    ->required(),
                Forms\Components\Toggle::make('security_system')
                    ->required(),
                Forms\Components\TextInput::make('min_stay_months')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('max_stay_months')
                    ->numeric(),
                Forms\Components\Toggle::make('flexible_contracts')
                    ->required(),
                Forms\Components\DatePicker::make('available_from'),
                Forms\Components\Toggle::make('currently_available')
                    ->required(),
                Forms\Components\TextInput::make('host_family_info'),
                Forms\Components\Toggle::make('meals_included')
                    ->required(),
                Forms\Components\TextInput::make('meal_plan'),
                Forms\Components\TextInput::make('transport_options'),
                Forms\Components\TextInput::make('distance_to_city_center_km')
                    ->numeric(),
                Forms\Components\Textarea::make('neighborhood_description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('quality_inspected')
                    ->required(),
                Forms\Components\TextInput::make('quality_rating')
                    ->numeric(),
                Forms\Components\TextInput::make('inspection_photos'),
                Forms\Components\DatePicker::make('last_inspection_date'),
                Forms\Components\Toggle::make('has_24_7_support')
                    ->required(),
                Forms\Components\Toggle::make('welcome_service')
                    ->required(),
                Forms\Components\Toggle::make('installation_assistance')
                    ->required(),
                Forms\Components\Toggle::make('maintenance_included')
                    ->required(),
                Forms\Components\TextInput::make('photos'),
                Forms\Components\TextInput::make('virtual_tour_urls'),
                Forms\Components\TextInput::make('required_documents'),
                Forms\Components\TextInput::make('testimonials'),
                Forms\Components\TextInput::make('average_rating')
                    ->numeric(),
                Forms\Components\TextInput::make('total_bookings')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('contact_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('booking_instructions')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('instant_booking')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\Toggle::make('verified_listing')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('housing_type'),
                Tables\Columns\TextColumn::make('housing_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('housing_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_price_monthly')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deposit_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agency_fees')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bathroom_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('surface_area_sqm')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('furnished')
                    ->boolean(),
                Tables\Columns\TextColumn::make('max_occupants')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('suitable_for_couples')
                    ->boolean(),
                Tables\Columns\IconColumn::make('utilities_included')
                    ->boolean(),
                Tables\Columns\IconColumn::make('cleaning_service')
                    ->boolean(),
                Tables\Columns\IconColumn::make('security_system')
                    ->boolean(),
                Tables\Columns\TextColumn::make('min_stay_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_stay_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('flexible_contracts')
                    ->boolean(),
                Tables\Columns\TextColumn::make('available_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('currently_available')
                    ->boolean(),
                Tables\Columns\IconColumn::make('meals_included')
                    ->boolean(),
                Tables\Columns\TextColumn::make('meal_plan'),
                Tables\Columns\TextColumn::make('distance_to_city_center_km')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('quality_inspected')
                    ->boolean(),
                Tables\Columns\TextColumn::make('quality_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_inspection_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_24_7_support')
                    ->boolean(),
                Tables\Columns\IconColumn::make('welcome_service')
                    ->boolean(),
                Tables\Columns\IconColumn::make('installation_assistance')
                    ->boolean(),
                Tables\Columns\IconColumn::make('maintenance_included')
                    ->boolean(),
                Tables\Columns\TextColumn::make('average_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_bookings')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('instant_booking')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('verified_listing')
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
            'index' => Pages\ListHousingServices::route('/'),
            'create' => Pages\CreateHousingService::route('/create'),
            'edit' => Pages\EditHousingService::route('/{record}/edit'),
        ];
    }
}
