<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirportPickupServiceResource\Pages;
use App\Filament\Resources\AirportPickupServiceResource\RelationManagers;
use App\Models\AirportPickupService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AirportPickupServiceResource extends Resource
{
    protected static ?string $model = AirportPickupService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('airport_code')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('airport_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255)
                    ->default('France'),
                Forms\Components\TextInput::make('base_price_0_20km')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('base_price_21_40km')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('base_price_41_60km')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price_per_km_beyond_60km')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('night_surcharge_percentage')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('weekend_surcharge_percentage')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('luggage_fee_per_bag')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('waiting_fee_per_hour')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('vehicle_types')
                    ->required(),
                Forms\Components\TextInput::make('service_start_time')
                    ->required(),
                Forms\Components\TextInput::make('service_end_time')
                    ->required(),
                Forms\Components\Toggle::make('operates_24_7')
                    ->required(),
                Forms\Components\TextInput::make('advance_booking_hours')
                    ->required()
                    ->numeric()
                    ->default(24),
                Forms\Components\TextInput::make('max_passengers')
                    ->required()
                    ->numeric()
                    ->default(4),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('currently_accepting_bookings')
                    ->required(),
                Forms\Components\TextInput::make('service_rating')
                    ->numeric(),
                Forms\Components\TextInput::make('total_transfers_completed')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('contact_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('special_instructions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('accepted_payment_methods'),
                Forms\Components\TextInput::make('covered_postcodes'),
                Forms\Components\TextInput::make('max_distance_km')
                    ->required()
                    ->numeric()
                    ->default(100.00),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('airport_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('airport_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_price_0_20km')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('base_price_21_40km')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('base_price_41_60km')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_per_km_beyond_60km')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('night_surcharge_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weekend_surcharge_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luggage_fee_per_bag')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waiting_fee_per_hour')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_start_time'),
                Tables\Columns\TextColumn::make('service_end_time'),
                Tables\Columns\IconColumn::make('operates_24_7')
                    ->boolean(),
                Tables\Columns\TextColumn::make('advance_booking_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_passengers')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('currently_accepting_bookings')
                    ->boolean(),
                Tables\Columns\TextColumn::make('service_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_transfers_completed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_distance_km')
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
            'index' => Pages\ListAirportPickupServices::route('/'),
            'create' => Pages\CreateAirportPickupService::route('/create'),
            'edit' => Pages\EditAirportPickupService::route('/{record}/edit'),
        ];
    }
}
