@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>

                    <h2 class="mb-3">
                        @if(app()->getLocale() == 'fr')
                            Inscription réussie !
                        @else
                            Registration Successful!
                        @endif
                    </h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="success-message mb-4">
                        @if(session('company_type') === 'hiring')
                            @if(app()->getLocale() == 'fr')
                                <p class="lead">Votre demande de recrutement de stagiaires internationaux a été enregistrée avec succès.</p>
                                <p>Notre équipe va examiner votre demande et vous contacter sous 24-48 heures pour discuter de vos besoins spécifiques.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Prochaines étapes :</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Vérification de votre demande par notre équipe</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Appel de découverte pour comprendre vos besoins</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Proposition de candidats qualifiés</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Accompagnement dans le processus de recrutement</li>
                                    </ul>
                                </div>
                            @else
                                <p class="lead">Your request for international intern recruitment has been successfully registered.</p>
                                <p>Our team will review your request and contact you within 24-48 hours to discuss your specific needs.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Next steps:</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Review of your request by our team</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Discovery call to understand your needs</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Proposal of qualified candidates</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Support throughout the recruitment process</li>
                                    </ul>
                                </div>
                            @endif

                        @elseif(session('company_type') === 'partnership')
                            @if(app()->getLocale() == 'fr')
                                <p class="lead">Votre demande de partenariat a été enregistrée avec succès.</p>
                                <p>Notre équipe commerciale va analyser votre demande et vous proposer une solution de partenariat adaptée à vos besoins.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Prochaines étapes :</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Analyse de votre demande de partenariat</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Rendez-vous stratégique avec notre équipe</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Proposition de partenariat personnalisée</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Mise en place de la collaboration</li>
                                    </ul>
                                </div>
                            @else
                                <p class="lead">Your partnership request has been successfully registered.</p>
                                <p>Our business team will analyze your request and propose a partnership solution tailored to your needs.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Next steps:</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Analysis of your partnership request</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Strategic meeting with our team</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Customized partnership proposal</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Implementation of collaboration</li>
                                    </ul>
                                </div>
                            @endif

                        @else
                            @if(app()->getLocale() == 'fr')
                                <p class="lead">Votre offre de stage a été publiée avec succès.</p>
                                <p>Elle sera visible par notre réseau d'étudiants internationaux après validation par notre équipe.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Prochaines étapes :</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Validation de votre offre par notre équipe</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Publication sur notre plateforme</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Diffusion auprès de candidats qualifiés</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Réception des candidatures</li>
                                    </ul>
                                </div>
                            @else
                                <p class="lead">Your internship offer has been successfully published.</p>
                                <p>It will be visible to our network of international students after validation by our team.</p>
                                
                                <div class="next-steps mt-4">
                                    <h5>Next steps:</h5>
                                    <ul class="list-unstyled text-left">
                                        <li><i class="fas fa-check text-success me-2"></i> Validation of your offer by our team</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Publication on our platform</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Distribution to qualified candidates</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Reception of applications</li>
                                    </ul>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="contact-info p-3 bg-light rounded">
                        <h6>
                            @if(app()->getLocale() == 'fr')
                                Des questions ?
                            @else
                                Questions?
                            @endif
                        </h6>
                        <p class="mb-0">
                            @if(app()->getLocale() == 'fr')
                                Contactez-nous à : <strong>contact@internshipmakers.com</strong><br>
                                Ou appelez-nous au : <strong>+33 1 23 45 67 89</strong>
                            @else
                                Contact us at: <strong>contact@internshipmakers.com</strong><br>
                                Or call us at: <strong>+33 1 23 45 67 89</strong>
                            @endif
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            @if(app()->getLocale() == 'fr')
                                Retour à l'accueil
                            @else
                                Back to Home
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.next-steps ul {
    max-width: 400px;
    margin: 0 auto;
}

.next-steps li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #dee2e6;
}

.next-steps li:last-child {
    border-bottom: none;
}

.contact-info {
    border-left: 4px solid #007bff;
}
</style>
@endsection