@extends('layouts.app')

@section('title', 'Demande de partenariat envoyée')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            
            {{-- Header avec animation --}}
            <div class="text-center mb-12 opacity-0 animate-fade-in-up">
                <div class="relative inline-block mb-8">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full blur-xl opacity-20 animate-pulse"></div>
                    <div class="relative bg-white rounded-full w-32 h-32 mx-auto flex items-center justify-center shadow-2xl border-4 border-white">
                        <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 bg-clip-text text-transparent mb-6 leading-tight">
                    Demande envoyée !
                </h1>
                
                <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Votre demande de partenariat a été transmise avec succès à notre équipe spécialisée.
                </p>
            </div>

            {{-- Message de session --}}
            @if(session('success'))
                <div class="mb-8 opacity-0 animate-fade-in-up animation-delay-200">
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-3 text-emerald-800 font-medium text-lg">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Contenu principal en grid --}}
            <div class="grid lg:grid-cols-3 gap-8 mb-12">
                
                {{-- Prochaines étapes --}}
                <div class="lg:col-span-2 opacity-0 animate-fade-in-up animation-delay-400">
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-6">
                            <div class="bg-gradient-to-r from-violet-500 to-purple-600 rounded-xl p-3 mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Prochaines étapes</h2>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4 group-hover:scale-110 transition-transform duration-300">
                                    1
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-800 mb-1">Analyse rapide</h3>
                                    <p class="text-slate-600">Notre équipe partenariats examine votre demande dans les <span class="font-semibold text-blue-600">24-48h</span></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4 group-hover:scale-110 transition-transform duration-300">
                                    2
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-800 mb-1">Entretien découverte</h3>
                                    <p class="text-slate-600">Discussion approfondie sur vos objectifs stratégiques et besoins spécifiques</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4 group-hover:scale-110 transition-transform duration-300">
                                    3
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-800 mb-1">Proposition sur mesure</h3>
                                    <p class="text-slate-600">Élaboration d'une stratégie de collaboration adaptée à votre entreprise</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4 group-hover:scale-110 transition-transform duration-300">
                                    4
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-800 mb-1">Mise en œuvre</h3>
                                    <p class="text-slate-600">Déploiement et suivi personnalisé de votre partenariat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar avec contact et avantages --}}
                <div class="space-y-8">
                    {{-- Contact --}}
                    <div class="opacity-0 animate-fade-in-up animation-delay-600">
                        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 text-white shadow-2xl">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 rounded-full mb-4 backdrop-blur-sm">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Équipe Partenariats</h3>
                                <p class="text-slate-300 text-sm">Experts dédiés à votre succès</p>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-slate-300">partenariats@nexaid.com</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-slate-300">+33 1 23 45 67 89</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-slate-300">Lun-Ven • 9h-18h</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Statistiques --}}
                    <div class="opacity-0 animate-fade-in-up animation-delay-800">
                        <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                            <h3 class="font-bold text-slate-800 mb-4 text-center">Nos performances</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="text-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">150+</div>
                                    <div class="text-sm text-slate-600 font-medium">Partenaires actifs</div>
                                </div>
                                <div class="text-center p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">98%</div>
                                    <div class="text-sm text-slate-600 font-medium">Satisfaction client</div>
                                </div>
                                <div class="text-center p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">24h</div>
                                    <div class="text-sm text-slate-600 font-medium">Temps de réponse</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Avantages en grid --}}
            <div class="mb-12 opacity-0 animate-fade-in-up animation-delay-1000">
                <div class="bg-gradient-to-r from-violet-50 via-purple-50 to-fuchsia-50 rounded-3xl p-8 border border-purple-100">
                    <h3 class="text-2xl font-bold text-center text-slate-800 mb-8">Ce qui vous attend</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800 mb-2">Stratégie personnalisée</h4>
                            <p class="text-sm text-slate-600">Collaboration sur mesure adaptée à vos objectifs</p>
                        </div>
                        
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800 mb-2">Réseau international</h4>
                            <p class="text-sm text-slate-600">Accès à notre écosystème mondial de talents</p>
                        </div>
                        
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800 mb-2">Outils exclusifs</h4>
                            <p class="text-sm text-slate-600">Ressources et technologies de pointe</p>
                        </div>
                        
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800 mb-2">Support dédié</h4>
                            <p class="text-sm text-slate-600">Accompagnement et formation continue</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions principales --}}
            <div class="text-center opacity-0 animate-fade-in-up animation-delay-1200">
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="{{ route('home') }}" 
                       class="group bg-gradient-to-r from-slate-800 to-slate-900 hover:from-slate-700 hover:to-slate-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 flex items-center justify-center shadow-xl hover:shadow-2xl hover:scale-105">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Retour à l'accueil
                    </a>
                    
                    <a href="{{ route('compagnies.register') }}" 
                       class="group bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-500 hover:to-purple-500 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 flex items-center justify-center shadow-xl hover:shadow-2xl hover:scale-105">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nouvelle demande
                    </a>
                </div>

                {{-- Conseil --}}
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 max-w-3xl mx-auto">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mr-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-lg">💡</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-blue-900 mb-2">Conseil d'expert</h4>
                            <p class="text-blue-800 text-sm leading-relaxed">
                                Préparez vos objectifs stratégiques et votre vision du partenariat idéal. 
                                Cette préparation optimisera notre première discussion et accélérera le processus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }

    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-400 { animation-delay: 0.4s; }
    .animation-delay-600 { animation-delay: 0.6s; }
    .animation-delay-800 { animation-delay: 0.8s; }
    .animation-delay-1000 { animation-delay: 1.0s; }
    .animation-delay-1200 { animation-delay: 1.2s; }

    /* Effet de parallaxe subtil */
    .bg-gradient-to-br {
        background-attachment: fixed;
    }

    /* Hover personnalisés */
    .group:hover .group-hover\:rotate-12 {
        transform: rotate(12deg);
    }
    
    .group:hover .group-hover\:rotate-90 {
        transform: rotate(90deg);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée progressive
    const elements = document.querySelectorAll('.animate-fade-in-up');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(element => {
        observer.observe(element);
    });

    // Effet de survol amélioré pour les cartes
    const cards = document.querySelectorAll('.bg-white, .bg-gradient-to-br');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Auto-scroll fluide après 2 secondes
    setTimeout(() => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }, 2000);
});
</script>
@endsection