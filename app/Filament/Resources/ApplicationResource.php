<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Candidatures';
    protected static ?string $pluralLabel = 'Candidatures';
    protected static ?string $navigationGroup = 'Gestion des stages';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations personnelles')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nom complet')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->label('Adresse email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->tel()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('linkedin')
                                    ->label('Profil LinkedIn')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Stage concerné')
                    ->schema([
                        Forms\Components\Select::make('internship_id')
                            ->label('Stage')
                            ->relationship('internship', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Profil candidat')
                    ->schema([
                        Forms\Components\Textarea::make('education')
                            ->label('Formation')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\Textarea::make('experience')
                            ->label('Expérience professionnelle')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\Textarea::make('cover_letter')
                            ->label('Lettre de motivation')
                            ->rows(5)
                            ->maxLength(2000),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Documents et validation')
                    ->schema([
                        Forms\Components\FileUpload::make('cv_path')
                            ->label('CV')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(5120)
                            ->downloadable(),
                        Forms\Components\Toggle::make('agree_terms')
                            ->label('Conditions générales acceptées')
                            ->disabled(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\ImageColumn::make('internship.image')
                        ->label('')
                        ->circular()
                        ->size(60)
                        ->defaultImageUrl('/images/default-internship.png'),
                    
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('name')
                            ->label('Candidat')
                            ->weight('bold')
                            ->size('lg')
                            ->searchable()
                            ->sortable(),
                        
                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\TextColumn::make('email')
                                ->label('Email')
                                ->icon('heroicon-m-envelope')
                                ->color('gray')
                                ->size('sm'),
                            Tables\Columns\TextColumn::make('phone')
                                ->label('Téléphone')
                                ->icon('heroicon-m-phone')
                                ->color('gray')
                                ->size('sm'),
                        ]),
                    ])->space(1),
                ])->from('md'),

                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('internship.title')
                                ->label('Stage')
                                ->weight('bold')
                                ->color('primary'),
                            Tables\Columns\TextColumn::make('internship.company_name')
                                ->label('Entreprise')
                                ->icon('heroicon-m-building-office')
                                ->color('gray'),
                            Tables\Columns\TextColumn::make('internship.location')
                                ->label('Lieu')
                                ->icon('heroicon-m-map-pin')
                                ->color('gray'),
                        ])->space(1),
                        
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\IconColumn::make('agree_terms')
                                ->label('CGV')
                                ->boolean()
                                ->trueIcon('heroicon-o-check-circle')
                                ->falseIcon('heroicon-o-x-circle')
                                ->trueColor('success')
                                ->falseColor('danger'),
                            Tables\Columns\TextColumn::make('status')
                                ->label('Statut')
                                ->badge()
                                ->formatStateUsing(fn ($state) => match($state) {
                                    'pending' => 'En attente',
                                    'accepted' => 'Acceptée',
                                    'rejected' => 'Refusée',
                                    'interview_scheduled' => 'Entretien',
                                    default => 'Inconnu'
                                })
                                ->color(fn ($state) => match($state) {
                                    'pending' => 'warning',
                                    'accepted' => 'success',
                                    'rejected' => 'danger',
                                    'interview_scheduled' => 'info',
                                    default => 'gray'
                                }),
                            Tables\Columns\TextColumn::make('created_at')
                                ->label('Candidature du')
                                ->dateTime('d/m/Y à H:i')
                                ->color('gray')
                                ->size('sm'),
                        ])->space(1)->alignment('end'),
                    ]),
                    
                    Tables\Columns\TextColumn::make('cover_letter')
                        ->label('Extrait de la lettre de motivation')
                        ->limit(150)
                        ->wrap()
                        ->color('gray')
                        ->size('sm'),
                ])->collapsible(),
            ])
            ->contentGrid([
                'md' => 1,
                'lg' => 1,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('internship')
                    ->relationship('internship', 'title')
                    ->label('Stage')
                    ->multiple()
                    ->preload(),
                
                Tables\Filters\Filter::make('has_cv')
                    ->label('Avec CV')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('cv_path')),
                
                Tables\Filters\Filter::make('terms_accepted')
                    ->label('CGV acceptées')
                    ->query(fn (Builder $query): Builder => $query->where('agree_terms', true)),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Candidatures depuis'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Candidatures jusqu\'au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Détails')
                    ->button()
                    ->outlined(),
                
                Tables\Actions\Action::make('download_cv')
                    ->label('CV')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(fn (Application $record): string => $record->cv_path ? asset('storage/' . $record->cv_path) : '#')
                    ->openUrlInNewTab()
                    ->button()
                    ->outlined()
                    ->visible(fn (Application $record): bool => !empty($record->cv_path))
                    ->color('success'),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('accept')
                        ->label('Accepter')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Accepter cette candidature')
                        ->modalDescription('Un email de confirmation sera automatiquement envoyé au candidat.')
                        ->form([
                            Forms\Components\Textarea::make('message')
                                ->label('Message personnalisé (optionnel)')
                                ->placeholder('Félicitations ! Votre candidature a été retenue...')
                                ->rows(4),
                        ])
                        ->action(function (Application $record, array $data) {
                            $record->update([
                                'status' => 'accepted',
                                'response_message' => $data['message'] ?? '',
                                'responded_at' => now()
                            ]);
                            
                            // Envoyer l'email automatiquement
                            \Mail::to($record->email)->send(new \App\Mail\ApplicationAccepted($record, $data['message'] ?? ''));
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Candidature acceptée')
                                ->body('Email envoyé automatiquement à ' . $record->email)
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\Action::make('reject')
                        ->label('Refuser')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Refuser cette candidature')
                        ->modalDescription('Un email sera automatiquement envoyé au candidat.')
                        ->form([
                            Forms\Components\Textarea::make('message')
                                ->label('Message de refus (optionnel)')
                                ->placeholder('Nous vous remercions pour votre candidature, cependant...')
                                ->rows(4),
                        ])
                        ->action(function (Application $record, array $data) {
                            $record->update([
                                'status' => 'rejected',
                                'response_message' => $data['message'] ?? '',
                                'responded_at' => now()
                            ]);
                            
                            // Envoyer l'email automatiquement
                            \Mail::to($record->email)->send(new \App\Mail\ApplicationRejected($record, $data['message'] ?? ''));
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Candidature refusée')
                                ->body('Email envoyé automatiquement à ' . $record->email)
                                ->info()
                                ->send();
                        }),

                    Tables\Actions\Action::make('interview')
                        ->label('Convoquer')
                        ->icon('heroicon-m-calendar-days')
                        ->color('info')
                        ->form([
                            Forms\Components\DateTimePicker::make('interview_date')
                                ->label('Date et heure d\'entretien')
                                ->required(),
                            Forms\Components\TextInput::make('interview_location')
                                ->label('Lieu (ou lien visio)')
                                ->placeholder('Adresse ou lien Zoom/Teams')
                                ->required(),
                            Forms\Components\Textarea::make('interview_message')
                                ->label('Message d\'invitation')
                                ->placeholder('Nous avons le plaisir de vous convoquer...')
                                ->rows(4),
                        ])
                        ->action(function (Application $record, array $data) {
                            $record->update([
                                'status' => 'interview_scheduled',
                                'interview_date' => $data['interview_date'],
                                'interview_location' => $data['interview_location'],
                                'response_message' => $data['interview_message'] ?? '',
                                'responded_at' => now()
                            ]);
                            
                            // Envoyer l'email automatiquement
                            \Mail::to($record->email)->send(new \App\Mail\InterviewInvitation($record, $data['interview_message'] ?? ''));
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Convocation envoyée')
                                ->body('Email de convocation envoyé à ' . $record->email)
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\Action::make('contact')
                        ->label('Email libre')
                        ->icon('heroicon-m-envelope')
                        ->form([
                            Forms\Components\TextInput::make('subject')
                                ->label('Objet')
                                ->default(fn (Application $record) => "Candidature - {$record->internship->title}")
                                ->required(),
                            Forms\Components\Textarea::make('message')
                                ->label('Message')
                                ->rows(6)
                                ->required(),
                        ])
                        ->action(function (Application $record, array $data) {
                            // Envoyer un email personnalisé
                            \Mail::raw($data['message'], function ($mail) use ($record, $data) {
                                $mail->to($record->email)
                                     ->subject($data['subject']);
                            });
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Email envoyé')
                                ->body('Email personnalisé envoyé à ' . $record->email)
                                ->success()
                                ->send();
                        }),
                ])
                ->label('Répondre')
                ->icon('heroicon-m-envelope')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export')
                        ->label('Exporter')
                        ->icon('heroicon-m-arrow-down-tray')
                        ->action(function ($records) {
                            // Action d'export personnalisée
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informations de candidature')
                    ->schema([
                        Infolists\Components\Split::make([
                            Infolists\Components\Grid::make(2)
                                ->schema([
                                    Infolists\Components\Group::make([
                                        Infolists\Components\TextEntry::make('name')
                                            ->label('Nom complet')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('email')
                                            ->label('Email')
                                            ->icon('heroicon-m-envelope')
                                            ->copyable(),
                                        Infolists\Components\TextEntry::make('phone')
                                            ->label('Téléphone')
                                            ->icon('heroicon-m-phone')
                                            ->copyable(),
                                        Infolists\Components\TextEntry::make('linkedin')
                                            ->label('LinkedIn')
                                            ->icon('heroicon-m-link')
                                            ->url(fn ($record) => $record->linkedin)
                                            ->openUrlInNewTab(),
                                    ]),
                                    Infolists\Components\Group::make([
                                        Infolists\Components\TextEntry::make('internship.title')
                                            ->label('Stage postulé')
                                            ->weight('bold')
                                            ->color('primary'),
                                        Infolists\Components\TextEntry::make('internship.company_name')
                                            ->label('Entreprise')
                                            ->icon('heroicon-m-building-office'),
                                        Infolists\Components\TextEntry::make('internship.location')
                                            ->label('Lieu')
                                            ->icon('heroicon-m-map-pin'),
                                        Infolists\Components\IconEntry::make('agree_terms')
                                            ->label('CGV acceptées')
                                            ->boolean(),
                                    ]),
                                ]),
                        ]),
                    ])
                    ->collapsible(),

                Infolists\Components\Section::make('Profil du candidat')
                    ->schema([
                        Infolists\Components\TextEntry::make('education')
                            ->label('Formation')
                            ->prose()
                            ->placeholder('Non renseigné'),
                        Infolists\Components\TextEntry::make('experience')
                            ->label('Expérience')
                            ->prose()
                            ->placeholder('Non renseigné'),
                        Infolists\Components\TextEntry::make('cover_letter')
                            ->label('Lettre de motivation')
                            ->prose()
                            ->placeholder('Non renseigné'),
                    ])
                    ->collapsible(),

                Infolists\Components\Section::make('Documents et métadonnées')
                    ->schema([
                        Infolists\Components\Split::make([
                            Infolists\Components\Group::make([
                                Infolists\Components\TextEntry::make('cv_path')
                                    ->label('CV')
                                    ->formatStateUsing(fn ($state) => $state ? 'CV téléchargé' : 'Aucun CV')
                                    ->badge()
                                    ->color(fn ($state) => $state ? 'success' : 'gray'),
                                Infolists\Components\Actions::make([
                                    Infolists\Components\Actions\Action::make('download_cv')
                                        ->label('Télécharger le CV')
                                        ->icon('heroicon-m-arrow-down-tray')
                                        ->url(fn ($record) => $record->cv_path ? asset('storage/' . $record->cv_path) : '#')
                                        ->openUrlInNewTab()
                                        ->visible(fn ($record) => !empty($record->cv_path)),
                                ]),
                            ]),
                            Infolists\Components\Group::make([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Date de candidature')
                                    ->dateTime('d/m/Y à H:i'),
                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Dernière modification')
                                    ->dateTime('d/m/Y à H:i'),
                            ]),
                        ]),
                    ])
                    ->collapsible(),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'view' => Pages\ViewApplication::route('/{record}'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }
}