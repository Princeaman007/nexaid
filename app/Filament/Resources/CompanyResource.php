<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Compagnies';
    protected static ?string $pluralLabel = 'Compagnies';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations générales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nom de la compagnie')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('website')
                                    ->label('Site web')
                                    ->url()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Textarea::make('address')
                            ->label('Adresse')
                            ->rows(2),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('company-logos'),

                        Forms\Components\Select::make('type')
                            ->label('Type de compagnie')
                            ->options(Company::TYPES)
                            ->required()
                            ->reactive(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),

                // Section pour type "hiring"
                Section::make('Recherche de stagiaires internationaux')
                    ->schema([
                        Forms\Components\TagsInput::make('sectors_interested')
                            ->label('Secteurs d\'intérêt')
                            ->placeholder('Ajouter un secteur...'),

                        Forms\Components\TagsInput::make('languages_needed')
                            ->label('Langues requises')
                            ->placeholder('Ajouter une langue...'),

                        Forms\Components\Select::make('intern_duration_preference')
                            ->label('Durée préférée des stages')
                            ->options([
                                '1-3_months' => '1-3 mois',
                                '3-6_months' => '3-6 mois',
                                '6-12_months' => '6-12 mois',
                                'flexible' => 'Flexible',
                            ]),

                        Forms\Components\TextInput::make('team_size')
                            ->label('Taille de l\'équipe')
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\Toggle::make('has_international_projects')
                            ->label('A des projets internationaux'),

                        Forms\Components\Textarea::make('cultural_diversity_goals')
                            ->label('Objectifs de diversité culturelle')
                            ->rows(3),
                    ])
                    ->visible(fn (Get $get): bool => $get('type') === Company::TYPE_HIRING),

                // Section pour type "partnership"
                Section::make('Partenariat avec la plateforme')
                    ->schema([
                        Forms\Components\Select::make('partnership_type')
                            ->label('Type de partenariat')
                            ->options([
                                'recruitment' => 'Recrutement',
                                'training' => 'Formation',
                                'consulting' => 'Conseil',
                                'other' => 'Autre',
                            ]),

                        Forms\Components\Textarea::make('collaboration_expectations')
                            ->label('Attentes de collaboration')
                            ->rows(3),

                        Forms\Components\TagsInput::make('services_needed')
                            ->label('Services requis')
                            ->placeholder('Ajouter un service...'),

                        Forms\Components\Select::make('partnership_duration')
                            ->label('Durée du partenariat')
                            ->options([
                                '3_months' => '3 mois',
                                '6_months' => '6 mois',
                                '1_year' => '1 an',
                                '2_years' => '2 ans',
                                'long_term' => 'Long terme',
                            ]),

                        Forms\Components\TextInput::make('budget_range')
                            ->label('Budget alloué')
                            ->numeric()
                            ->prefix('€'),

                        Forms\Components\Toggle::make('long_term_partnership')
                            ->label('Partenariat à long terme'),
                    ])
                    ->visible(fn (Get $get): bool => $get('type') === Company::TYPE_PARTNERSHIP),

                // Section pour type "offer_sender"
                Section::make('Offre de stage')
                    ->schema([
                        Forms\Components\TextInput::make('offer_title')
                            ->label('Titre de l\'offre')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('offer_description')
                            ->label('Description de l\'offre')
                            ->rows(4),

                        Forms\Components\TagsInput::make('required_skills')
                            ->label('Compétences requises')
                            ->placeholder('Ajouter une compétence...'),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('offer_location')
                                    ->label('Lieu de l\'offre')
                                    ->maxLength(255),

                                Forms\Components\Toggle::make('remote_possible')
                                    ->label('Télétravail possible'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('offer_start_date')
                                    ->label('Date de début'),

                                Forms\Components\DatePicker::make('offer_end_date')
                                    ->label('Date de fin'),
                            ]),

                        Forms\Components\TextInput::make('salary_amount')
                            ->label('Salaire/Indemnité')
                            ->numeric()
                            ->prefix('€'),

                        Forms\Components\Select::make('offer_status')
                            ->label('Statut de l\'offre')
                            ->options(Company::OFFER_STATUSES)
                            ->default(Company::OFFER_STATUS_DRAFT),
                    ])
                    ->visible(fn (Get $get): bool => $get('type') === Company::TYPE_OFFER_SENDER),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => Company::TYPES[$state] ?? $state)
                    ->colors([
                        'primary' => Company::TYPE_HIRING,
                        'success' => Company::TYPE_PARTNERSHIP,
                        'warning' => Company::TYPE_OFFER_SENDER,
                    ]),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\IconColumn::make('verified_at')
                    ->label('Vérifiée')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !is_null($record->verified_at)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options(Company::TYPES),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),

                Tables\Filters\TernaryFilter::make('verified_at')
                    ->label('Vérifiée')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('verify')
                    ->label('Vérifier')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->action(fn (Company $record) => $record->markAsVerified())
                    ->visible(fn (Company $record) => !$record->isVerified()),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}