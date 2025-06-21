@extends('layouts.app')

@section('title', 'Inscription réussie')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        
        {{-- Icône de succès --}}
        <div class="mb-8">
            <div class="bg-green-100 rounded-full w-24 h-24 mx-auto flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        {{-- Message de succès --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Inscription réussie !
        </h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                <p class="text-green-800 text-lg font-medium">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        {{-- Contenu selon le type --}}
        @php
            $companyType = session('company_type', 'default');
        @endphp

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 text-left">
            @switch($companyType)
                @case('hiring')
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Prochaines étapes pour le recrutement :</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">1</span>
                            <span>Notre équipe va analyser vos besoins dans les <strong>24-48h</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">2</span>
                            <span>Nous vous contacterons pour définir ensemble le profil idéal</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">3</span>
                            <span>Présélection et présentation des candidats qualifiés</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">4</span>
                            <span>Accompagnement jusqu'à l'intégration du stagiaire</span>
                        </li>
                    </ul>
                    @break

                @case('partnership')
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Prochaines étapes pour le partenariat :</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="bg-purple-100 text-purple-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">1</span>
                            <span>Analyse de votre demande par notre équipe partenariats</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-purple-100 text-purple-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">2</span>
                            <span>Entretien de découverte pour comprendre vos objectifs</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-purple-100 text-purple-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">3</span>
                            <span>Proposition d'une collaboration sur mesure</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-purple-100 text-purple-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">4</span>
                            <span>Mise en place et suivi du partenariat</span>
                        </li>
                    </ul>
                    @break

                @case('offer_sender')
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Votre offre de stage :</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="bg-green-100 text-green-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">1</span>
                            <span>Votre offre sera <strong>vérifiée et validée</strong> sous 24h</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-green-100 text-green-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">2</span>
                            <span>Publication sur notre plateforme et diffusion ciblée</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-green-100 text-green-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">3</span>
                            <span>Réception des candidatures pré-qualifiées</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-green-100 text-green-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">4</span>
                            <span>Support pour le processus de sélection</span>
                        </li>
                    </ul>
                    @break

                @default
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Prochaines étapes :</h2>
                    <p class="text-gray-600">
                        Notre équipe va examiner votre demande et vous contacter dans les plus brefs délais.
                    </p>
            @endswitch
        </div>

        {{-- Informations de contact --}}
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Besoin d'aide ?</h3>
            <p class="text-gray-600 mb-4">
                Notre équipe est disponible pour répondre à toutes vos questions.
            </p>
            <div class="flex justify-center space-x-6 text-sm">
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    contact@stages-internationaux.com
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +33 1 23 45 67 89
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                Retour à l'accueil
            </a>
            
            @if($companyType === 'offer_sender')
                <a href="{{ route('company.offer-sender') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Publier une autre offre
                </a>
            @else
                <a href="{{ route('company.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    Voir toutes les entreprises
                </a>
            @endif
        </div>

        {{-- Newsletter ou suivi --}}
        <div class="mt-8 p-4 bg-blue-50 rounded-lg">
            <p class="text-blue-800 text-sm">
                💡 <strong>Conseil :</strong> Nous vous recommandons de préparer un guide d'accueil pour faciliter l'intégration de votre futur stagiaire international.
            </p>
        </div>
    </div>
</div>
@endsection