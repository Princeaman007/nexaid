<?php

// resources/views/emails/company/registration-approved.blade.php
@component('mail::message')
# Félicitations ! Votre inscription a été approuvée

Bonjour {{ $company->name }},

Nous avons le plaisir de vous informer que votre demande d'inscription a été **approuvée** avec succès.

## Détails de votre inscription
- **Type** : {{ $typeLabel }}
- **Date d'approbation** : {{ now()->format('d/m/Y à H:i') }}
- **Statut** : Actif

## Prochaines étapes

@if($registration->type === 'hiring')
Vous pouvez maintenant :
- Accéder à notre base de candidats internationaux
- Publier vos besoins de recrutement
- Bénéficier de notre service de matching

@component('mail::button', ['url' => route('company.dashboard')])
Accéder à votre espace recrutement
@endcomponent

@elseif($registration->type === 'partnership')
Notre équipe partenariats va prendre contact avec vous dans les **48 heures** pour :
- Définir les modalités de collaboration
- Élaborer votre offre personnalisée
- Planifier le lancement de votre partenariat

@component('mail::button', ['url' => route('company.partnership.dashboard')])
Voir votre espace partenariat
@endcomponent

@elseif($registration->type === 'offer_sender')
Votre offre de stage a été automatiquement publiée sur notre plateforme. Vous allez recevoir les premières candidatures sous peu.

@component('mail::button', ['url' => route('company.offers.dashboard')])
Gérer vos offres
@endcomponent
@endif

## Support

Notre équipe reste à votre disposition pour toute question :
- **Email** : support@stages-internationaux.com
- **Téléphone** : +33 1 23 45 67 89
- **Chat en ligne** : Disponible sur votre espace

Merci de nous faire confiance !

L'équipe Stages Internationaux
@endcomponent

// resources/views/emails/company/registration-rejected.blade.php
@component('mail::message')
# Concernant votre demande d'inscription

Bonjour {{ $company->name }},

Nous avons étudié attentivement votre demande d'inscription, mais malheureusement nous ne pouvons pas y donner suite pour le moment.

## Motif
{{ $rejectionReason }}

## Que faire maintenant ?

Ne vous découragez pas ! Voici comment améliorer votre dossier :

### ✅ Vérifications importantes
- Complétez tous les champs obligatoires
- Utilisez une adresse email professionnelle
- Fournissez un site web d'entreprise valide
- Ajoutez une description détaillée de votre activité

### 📞 Besoin d'aide ?
Notre équipe est là pour vous accompagner :

@component('mail::button', ['url' => route('contact')])
Nous contacter
@endcomponent

### 🔄 Nouvelle tentative
Vous pouvez soumettre une nouvelle demande à tout moment :

@component('mail::button', ['url' => route('company.register')])
Réessayer
@endcomponent

## Exemples de profils acceptés

**Entreprises de 5+ employés** avec :
- Site web professionnel
- Adresse email sur domaine d'entreprise
- Description claire de l'activité
- Projets concrets de recrutement/partenariat

Cordialement,  
L'équipe Stages Internationaux
@endcomponent

// app/Notifications/WelcomeNotification.php
namespace App\Notifications;

use App\Models\CompanyRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private CompanyRegistration $registration
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bienvenue dans l\'écosystème Stages Internationaux !')
            ->markdown('emails.company.welcome', [
                'company' => $notifiable,
                'registration' => $this->registration,
                'nextSteps' => $this->getNextSteps()
            ]);
    }

    private function getNextSteps(): array
    {
        return match($this->registration->type) {
            'hiring' => [
                'Consultez notre base de talents internationaux',
                'Définissez vos critères de recherche',
                'Programmez un entretien avec nos conseillers',
                'Recevez vos premiers profils sous 24h'
            ],
            'partnership' => [
                'Rendez-vous de découverte programmé',
                'Audit de vos besoins RH',
                'Proposition de partenariat personnalisée',
                'Démarrage de la collaboration'
            ],
            'offer_sender' => [
                'Votre offre est en ligne',
                'Optimisation de votre annonce',
                'Réception des candidatures',
                'Support pour la sélection'
            ],
            default => []
        };
    }
}

// resources/views/emails/company/welcome.blade.php
@component('mail::message')
# 🎉 Bienvenue {{ $company->name }} !

Votre inscription a été validée avec succès. Nous sommes ravis de vous accueillir dans notre écosystème d'innovation internationale.

## 🚀 Vos prochaines étapes

@foreach($nextSteps as $step)
{{ $loop->iteration }}. {{ $step }}
@endforeach

## 📊 Votre digest hebdomadaire

Bonjour {{ $company->name }},

Voici un récapitulatif de votre activité cette semaine sur notre plateforme.

## 📈 Vos statistiques

@component('mail::panel')
**Cette semaine :**
- 👀 **{{ $stats['profile_views'] }}** vues de votre profil
- 📝 **{{ $stats['applications_received'] }}** nouvelles candidatures
- 💬 **{{ $stats['messages_exchanged'] }}** messages échangés
- ⭐ **{{ $stats['favorites_added'] }}** mises en favoris

**Évolution :**
- {{ $stats['growth_percentage'] }}% par rapport à la semaine dernière
@endcomponent

## 🎯 Actions recommandées

@if($stats['applications_received'] == 0)
### 🔥 Boostez votre visibilité
Aucune candidature cette semaine ? Voici comment améliorer :
- Actualisez vos offres de stage
- Ajoutez des photos de votre équipe
- Partagez vos projets innovants
- Mettez à jour votre description

@component('mail::button', ['url' => route('company.profile.edit')])
Optimiser mon profil
@endcomponent

@elseif($stats['applications_received'] > 5)
### 🚀 Excellent momentum !
{{ $stats['applications_received'] }} candidatures cette semaine, bravo !
- Répondez rapidement pour maintenir l'engagement
- Planifiez vos entretiens
- Utilisez nos modèles de réponse

@component('mail::button', ['url' => route('company.applications')])
Gérer mes candidatures
@endcomponent

@else
### 📊 Activité stable
Continuez sur cette lancée :
- Maintenez votre niveau de réactivité
- Explorez de nouveaux profils
- Laissez des avis constructifs
@endif

## 🌟 Nouveautés de la semaine

### 🆕 Nouvelles fonctionnalités
- **Matching IA amélioré** : Algorithme plus précis
- **Chat vidéo intégré** : Entretiens directement sur la plateforme
- **Analytics avancés** : Nouveaux insights sur vos performances

### 🎓 Nouveaux talents disponibles
- **{{ $stats['new_candidates'] }}** nouveaux profils cette semaine
- Spécialités demandées : {{ implode(', ', $stats['trending_skills']) }}
- Nationalités : {{ implode(', ', $stats['new_countries']) }}

@component('mail::button', ['url' => route('company.candidates.browse')])
Découvrir les nouveaux profils
@endcomponent

## 📚 Ressources de la semaine

### 📖 Article recommandé
**"Comment intégrer efficacement un stagiaire international"**
*Les meilleures pratiques pour un onboarding réussi*

[Lire l'article →]({{ route('blog.integration-guide') }})

### 🎥 Webinaire à venir
**"Tendances du recrutement international 2024"**
*Jeudi 15 février à 14h*

[S'inscrire gratuitement →]({{ route('webinars.trends-2024') }})

## 💡 Conseil de la semaine

> **Saviez-vous que** les entreprises qui répondent aux candidatures dans les 24h ont 3x plus de chances de décrocher le candidat idéal ?

### ⚡ Actions rapides disponibles :
- Modèles de réponse automatique
- Notifications push sur mobile
- Délégation à vos collaborateurs

## 🏆 Entreprise à l'honneur

Cette semaine, félicitations à **TechVision** qui a recruté 3 stagiaires internationaux et obtenu une note de satisfaction de 4.9/5 !

*"L'accompagnement est exceptionnel, nos stagiaires sont parfaitement intégrés."*  
— Sarah Martin, RH chez TechVision

## 📞 Besoin d'aide ?

Notre équipe reste disponible :
- **Chat en ligne** : 9h-18h du lundi au vendredi
- **Email** : support@stages-internationaux.com  
- **Téléphone** : +33 1 23 45 67 89

---

@component('mail::subcopy')
Vous recevez cet email car vous êtes inscrit à notre digest hebdomadaire.  
[Se désinscrire]({{ route('unsubscribe', ['token' => $company->unsubscribe_token]) }}) | [Gérer mes préférences]({{ route('company.email-preferences') }})
@endcomponent

@endcomponent

// app/Console/Commands/SendWeeklyDigests.php
namespace App\Console\Commands;

use App\Mail\WeeklyCompanyDigest;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeeklyDigests extends Command
{
    protected $signature = 'company:send-weekly-digests';
    protected $description = 'Send weekly digest emails to active companies';

    public function handle(): void
    {
        $companies = Company::where('status', 'active')
            ->whereHas('registrations', function ($query) {
                $query->where('status', 'approved');
            })
            ->get();

        $this->info("Sending weekly digests to {$companies->count()} companies...");

        foreach ($companies as $company) {
            $stats = $this->calculateCompanyStats($company);
            
            Mail::to($company->email)->send(
                new WeeklyCompanyDigest($company, $stats)
            );
            
            $this->info("Sent digest to {$company->name}");
        }

        $this->info('All weekly digests sent successfully!');
    }

    private function calculateCompanyStats(Company $company): array
    {
        // Simuler des statistiques (remplacer par vraies métriques)
        return [
            'profile_views' => rand(10, 50),
            'applications_received' => rand(0, 15),
            'messages_exchanged' => rand(5, 25),
            'favorites_added' => rand(1, 8),
            'growth_percentage' => rand(-20, 50),
            'new_candidates' => rand(15, 45),
            'trending_skills' => ['JavaScript', 'Python', 'Marketing Digital'],
            'new_countries' => ['Espagne', 'Italie', 'Allemagne'],
        ];
    }
}

// app/Filament/Resources/EmailTemplateResource.php
namespace App\Filament\Resources;

use App\Models\EmailTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmailTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Templates Email';
    protected static ?string $navigationGroup = 'Communication';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Configuration du template')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom du template')
                            ->required(),
                        
                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'registration_approved' => 'Inscription approuvée',
                                'registration_rejected' => 'Inscription rejetée',
                                'welcome' => 'Bienvenue',
                                'weekly_digest' => 'Digest hebdomadaire',
                                'offer_published' => 'Offre publiée',
                                'partnership_confirmed' => 'Partenariat confirmé',
                            ])
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->placeholder('Ex: Votre inscription a été approuvée'),
                        
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenu HTML')
                            ->required()
                            ->placeholder('Rédigez votre template email...')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h1', 'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote', 'codeBlock'
                            ]),
                        
                        Forms\Components\Textarea::make('variables')
                            ->label('Variables disponibles')
                            ->placeholder('{{ $company->name }}, {{ $registration->type }}, etc.')
                            ->rows(3)
                            ->helperText('Listez les variables utilisables dans ce template'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'success' => 'registration_approved',
                        'danger' => 'registration_rejected', 
                        'info' => 'welcome',
                        'warning' => 'weekly_digest',
                    ]),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->limit(50),
                
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif'),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('preview')
                    ->label('Aperçu')
                    ->icon('heroicon-o-eye')
                    ->url(fn (EmailTemplate $record) => route('email-template.preview', $record))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => EmailTemplateResource\Pages\ListEmailTemplates::route('/'),
            'create' => EmailTemplateResource\Pages\CreateEmailTemplate::route('/create'),
            'edit' => EmailTemplateResource\Pages\EditEmailTemplate::route('/{record}/edit'),
        ];
    }
}

// app/Models/EmailTemplate.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'subject',
        'content',
        'variables',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'variables' => 'array',
    ];

    public function render(array $data = []): string
    {
        $content = $this->content;
        
        foreach ($data as $key => $value) {
            $content = str_replace("{{ \$key }}", $value, $content);
        }
        
        return $content;
    }
}

// Migration pour EmailTemplate
// database/migrations/create_email_templates_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('subject');
            $table->longText('content');
            $table->text('variables')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};

// app/Console/Kernel.php (Ajout des tâches programmées)
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Digest hebdomadaire chaque lundi à 9h
        $schedule->command('company:send-weekly-digests')
                 ->weeklyOn(1, '9:00')
                 ->timezone('Europe/Paris');
        
        // Nettoyage des anciennes données
        $schedule->command('model:prune')
                 ->daily();
        
        // Sauvegarde quotidienne
        $schedule->command('backup:run')
                 ->daily()
                 ->at('02:00');
    }

    protected $commands = [
        Commands\SendWeeklyDigests::class,
    ];
}Votre tableau de bord

Accédez dès maintenant à votre espace personnalisé :

@component('mail::button', ['url' => route('company.dashboard')])
Mon espace entreprise
@endcomponent

## 🎯 Ressources utiles

### 📖 Guides pratiques
- [Guide du recrutement international]({{ route('guides.recruitment') }})
- [Bonnes pratiques d'intégration]({{ route('guides.integration') }})
- [FAQ Entreprises]({{ route('faq.companies') }})

### 🤝 Votre équipe dédiée
- **Conseiller principal** : Marie Dubois (marie@stages-internationaux.com)
- **Support technique** : support@stages-internationaux.com
- **Urgences** : +33 1 23 45 67 89

## 📈 Optimisez vos résultats

@if($registration->type === 'hiring')
### Conseils pour attirer les meilleurs talents :
- ✨ **Rédigez des offres attractives** avec missions claires
- 🌍 **Mettez en avant l'international** dans vos projets  
- 💰 **Proposez une rémunération competitive**
- 🏢 **Présentez votre culture d'entreprise**

@elseif($registration->type === 'partnership')
### Maximisez votre partenariat :
- 🎯 **Définissez des objectifs précis** ensemble
- 📊 **Suivez les KPIs** de performance
- 🔄 **Communiquez régulièrement** avec votre conseiller
- 🚀 **Explorez de nouvelles opportunités** de collaboration

@elseif($registration->type === 'offer_sender')
### Boostez vos candidatures :
- 📝 **Optimisez vos annonces** avec des mots-clés pertinents
- ⚡ **Répondez rapidement** aux candidatures
- 📱 **Utilisez nos outils** de suivi intégrés
- 🌟 **Collectez des avis** de vos stagiaires
@endif

## 🏆 Programmes exclusifs

En tant que partenaire, vous bénéficiez de :

@component('mail::panel')
🎖️ **Badge Entreprise Partenaire**  
🎯 **Accès prioritaire** aux meilleurs profils  
📊 **Reporting avancé** et analytics  
🤝 **Support dédié** 7j/7  
🌍 **Réseau international** d'entreprises  
@endcomponent

---

*Cet email a été envoyé automatiquement suite à l'approbation de votre inscription le {{ now()->format('d/m/Y à H:i') }}.*

L'équipe Stages Internationaux  
*Connecter les talents, créer l'avenir*
@endcomponent

// app/Mail/WeeklyCompanyDigest.php
namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyCompanyDigest extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private Company $company,
        private array $stats
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre digest hebdomadaire - Stages Internationaux',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.company.weekly-digest',
            with: [
                'company' => $this->company,
                'stats' => $this->stats,
            ]
        );
    }
}

// resources/views/emails/company/weekly-digest.blade.php
@component('mail::message')
# 📊