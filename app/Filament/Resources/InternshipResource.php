<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipResource\Pages;
use App\Models\Internship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;

class InternshipResource extends Resource
{
    protected static ?string $model = Internship::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationLabel = 'Internships';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Internship')
                ->tabs([
                    Tabs\Tab::make('Basic Information')->schema([
                        TextInput::make('title.en')
                            ->required()
                            ->label('Title (English)'),
                            
                        TextInput::make('title.fr')
                            ->label('Title (French)'),
                            
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('This will be used as the URL. Use only lowercase letters, numbers, and hyphens.')
                            ->afterStateUpdated(function (string $context, $state, callable $set, $get) {
                                if ($context === 'create') {
                                    $set('slug', \Illuminate\Support\Str::slug($state));
                                }
                            }),
                            
                        Select::make('category_id')
                            ->relationship('category', titleAttribute: 'name')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->getTranslation('name', app()->getLocale()))
                            ->required()
                            ->label('Category')
                            ->searchable()
                            ->preload(),
                            
                        TextInput::make('company_name')
                            ->required()
                            ->label('Company Name'),
                            
                        RichEditor::make('company_description.en')
                            ->label('Company Description (English)')
                            ->helperText('Provide information about the company hosting the internship.')
                            ->columnSpanFull(),
                            
                        RichEditor::make('company_description.fr')
                            ->label('Company Description (French)')
                            ->helperText('Description de l\'entreprise qui propose le stage.')
                            ->columnSpanFull(),
                            
                        TextInput::make('location')
                            ->required()
                            ->label('Location'),
                            
                        FileUpload::make('image')
                            ->label('Featured Image')
                            ->image()
                            ->directory('internships')
                            ->maxSize(5120) // 5MB
                            ->helperText('Recommended size: 1200 x 800 pixels'),
                            
                        Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Only active internships will be displayed on the website.')
                            ->default(true),
                            
                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->helperText('Featured internships will be displayed on the homepage and featured page.')
                            ->default(false),
                    ]),
                    
                    Tabs\Tab::make('Description')->schema([
                        RichEditor::make('description.en')
                            ->required()
                            ->label('Description (English)')
                            ->helperText('Provide a detailed description of the internship, including responsibilities and requirements.')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('internships/attachments'),
                            
                        RichEditor::make('description.fr')
                            ->label('Description (French)')
                            ->helperText('Provide a detailed description of the internship, including responsibilities and requirements.')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('internships/attachments'),
                    ]),

                    Tabs\Tab::make('Main Responsibilities')->schema([
                        Repeater::make('main_responsibilities.en')
                            ->label('Main Responsibilities (English)')
                            ->schema([
                                TextInput::make('responsibility')
                                    ->required()
                                    ->label('Responsibility')
                                    ->placeholder('Process invoices and payments of the suppliers')
                            ])
                            ->defaultItems(5)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['responsibility'] ?? null),
                            
                        Repeater::make('main_responsibilities.fr')
                            ->label('Main Responsibilities (French)')
                            ->schema([
                                TextInput::make('responsibility')
                                    ->required()
                                    ->label('Responsabilité')
                                    ->placeholder('Traiter les factures et paiements des fournisseurs')
                            ])
                            ->defaultItems(5)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['responsibility'] ?? null),
                    ]),
                    
                    Tabs\Tab::make('Learning Outcomes')->schema([
                        Repeater::make('learning_outcomes.en')
                            ->label('Learning Outcomes (English)')
                            ->schema([
                                TextInput::make('outcome')
                                    ->required()
                                    ->label('Outcome')
                                    ->placeholder('What interns will learn')
                            ])
                            ->defaultItems(5)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['outcome'] ?? null),
                            
                        Repeater::make('learning_outcomes.fr')
                            ->label('Learning Outcomes (French)')
                            ->schema([
                                TextInput::make('outcome')
                                    ->required()
                                    ->label('Résultat d\'apprentissage')
                                    ->placeholder('Ce que les stagiaires apprendront')
                            ])
                            ->defaultItems(5)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['outcome'] ?? null),
                    ]),
                    
                    Tabs\Tab::make('Requirements')->schema([
                        TextInput::make('required_language')
                            ->label('Required Language(s)')
                            ->placeholder('English (Professional), French (Basic)'),
                            
                        Repeater::make('required_skills.en')
                            ->label('Required Skills (English)')
                            ->schema([
                                TextInput::make('skill')
                                    ->required()
                                    ->label('Skill')
                                    ->placeholder('E.g. JavaScript, Marketing, Communication')
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['skill'] ?? null),
                            
                        Repeater::make('required_skills.fr')
                            ->label('Required Skills (French)')
                            ->schema([
                                TextInput::make('skill')
                                    ->required()
                                    ->label('Compétence')
                                    ->placeholder('Ex: JavaScript, Marketing, Communication')
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['skill'] ?? null),
                            
                        Repeater::make('qualifications.en')
                            ->label('Qualifications Required (English)')
                            ->schema([
                                TextInput::make('qualification')
                                    ->required()
                                    ->label('Qualification')
                                    ->placeholder('E.g. Bachelor\'s in Accounting, Student status')
                            ])
                            ->defaultItems(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['qualification'] ?? null),
                            
                        Repeater::make('qualifications.fr')
                            ->label('Qualifications Required (French)')
                            ->schema([
                                TextInput::make('qualification')
                                    ->required()
                                    ->label('Qualification')
                                    ->placeholder('Ex: Licence en comptabilité, Statut étudiant')
                            ])
                            ->defaultItems(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['qualification'] ?? null),
                            
                        Select::make('internship_level')
                            ->label('Internship Level')
                            ->options([
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                            ])
                            ->default('intermediate'),
                    ]),
                    
                    Tabs\Tab::make('Conditions')->schema([
                        TextInput::make('duration')
                            ->label('Duration')
                            ->placeholder('3-6 months'),
                            
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->helperText('Leave blank if flexible'),
                            
                        DatePicker::make('application_deadline')
                            ->label('Application Deadline')
                            ->helperText('Leave blank if no specific deadline'),
                            
                        TextInput::make('compensation')
                            ->label('Compensation')
                            ->placeholder('€500/month or Unpaid'),
                            
                        Select::make('position_type')
                            ->label('Position Type')
                            ->options([
                                'full-time' => 'Full-time',
                                'part-time' => 'Part-time',
                                'flexible' => 'Flexible',
                            ])
                            ->default('full-time'),
                            
                        Select::make('remote_option')
                            ->label('Remote Option')
                            ->options([
                                'on-site' => 'On-site',
                                'remote' => 'Remote',
                                'hybrid' => 'Hybrid',
                            ])
                            ->default('on-site'),
                            
                        Repeater::make('benefits.en')
                            ->label('Benefits (English)')
                            ->schema([
                                TextInput::make('benefit')
                                    ->required()
                                    ->label('Benefit')
                                    ->placeholder('E.g. Flexible hours, Lunch provided')
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['benefit'] ?? null),
                            
                        Repeater::make('benefits.fr')
                            ->label('Benefits (French)')
                            ->schema([
                                TextInput::make('benefit')
                                    ->required()
                                    ->label('Avantage')
                                    ->placeholder('Ex: Horaires flexibles, Repas fournis')
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['benefit'] ?? null),
                    ]),
                    
                    Tabs\Tab::make('Application Process')->schema([
                        RichEditor::make('application_process.en')
                            ->label('Application Process (English)')
                            ->helperText('Describe the application and selection process.')
                            ->placeholder('e.g. Send your CV and cover letter. First interview by phone, then in-person interview.'),
                            
                        RichEditor::make('application_process.fr')
                            ->label('Application Process (French)')
                            ->helperText('Décrivez le processus de candidature et de sélection.')
                            ->placeholder('ex: Envoyez votre CV et lettre de motivation. Premier entretien par téléphone, puis entretien en personne.'),
                            
                        TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->helperText('Email address for inquiries about this internship.'),
                            
                        TextInput::make('contact_phone')
                            ->label('Contact Phone')
                            ->tel()
                            ->helperText('Phone number for inquiries about this internship.'),
                    ]),
                ])
                ->columnSpan('full'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (Model $record): string => $record->getTranslation('title', app()->getLocale())),
                    
                TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),
                    
                TextColumn::make('category.name')
                    ->label('Category')
                    ->formatStateUsing(fn (Model $record): string => 
                        $record->category ? $record->category->getTranslation('name', app()->getLocale()) : ''),
                    
                TextColumn::make('position_type')
                    ->label('Type')
                    ->searchable(),
                    
                TextColumn::make('application_deadline')
                    ->label('Deadline')
                    ->date(),
                    
                BooleanColumn::make('is_active')
                    ->label('Active'),
                    
                BooleanColumn::make('is_featured')
                    ->label('Featured'),
                    
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', titleAttribute: 'name')
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => 
                        $record->getTranslation('name', app()->getLocale()))
                    ->label('Category'),
                    
                Tables\Filters\SelectFilter::make('position_type')
                    ->options([
                        'full-time' => 'Full-time',
                        'part-time' => 'Part-time',
                        'flexible' => 'Flexible',
                    ])
                    ->label('Position Type'),
                    
                Tables\Filters\SelectFilter::make('remote_option')
                    ->options([
                        'on-site' => 'On-site',
                        'remote' => 'Remote',
                        'hybrid' => 'Hybrid',
                    ])
                    ->label('Remote Option'),

                Tables\Filters\SelectFilter::make('internship_level')
                    ->options([
                        'beginner' => 'Beginner',
                        'intermediate' => 'Intermediate',
                        'advanced' => 'Advanced',
                    ])
                    ->label('Level'),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
                    
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListInternships::route('/'),
            'create' => Pages\CreateInternship::route('/create'),
            'edit' => Pages\EditInternship::route('/{record}/edit'),
        ];
    }
}