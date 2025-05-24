@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; text-align: center; padding: 50px 20px;">
        <div style="font-size: 60px; color: #28a745; margin-bottom: 20px;">✓</div>
        
        <h1 style="color: #343a40; margin-bottom: 20px;">
            @if(app()->getLocale() == 'fr')
                Votre candidature a été envoyée avec succès !
            @else
                Your application has been successfully submitted!
            @endif
        </h1>
        
        <p style="color: #6c757d; font-size: 1.1em; margin-bottom: 30px;">
            @if(app()->getLocale() == 'fr')
                Nous avons bien reçu votre candidature pour le stage : <strong>{{ session('internship') }}</strong>
            @else
                We have received your application for the internship: <strong>{{ session('internship') }}</strong>
            @endif
        </p>
        
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px; text-align: left;">
            <h3 style="color: #343a40; margin-top: 0;">
                @if(app()->getLocale() == 'fr')
                    Que se passe-t-il maintenant ?
                @else
                    What happens next?
                @endif
            </h3>
            
            <ol style="color: #495057; padding-left: 20px;">
                <li style="margin-bottom: 10px;">
                    @if(app()->getLocale() == 'fr')
                        Votre candidature sera examinée par notre équipe et transmise à l'entreprise.
                    @else
                        Your application will be reviewed by our team and forwarded to the company.
                    @endif
                </li>
                <li style="margin-bottom: 10px;">
                    @if(app()->getLocale() == 'fr')
                        Si votre profil correspond aux attentes, vous serez contacté(e) pour un entretien.
                    @else
                        If your profile matches the expectations, you will be contacted for an interview.
                    @endif
                </li>
                <li style="margin-bottom: 10px;">
                    @if(app()->getLocale() == 'fr')
                        Vous recevrez un email de confirmation à l'adresse que vous avez fournie.
                    @else
                        You will receive a confirmation email at the address you provided.
                    @endif
                </li>
            </ol>
        </div>
        
        <div>
            <a href="{{ route('internships.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px; display: inline-block;">
                @if(app()->getLocale() == 'fr')
                    Retour à la liste des stages
                @else
                    Back to internship list
                @endif
            </a>
        </div>
    </div>
@endsection