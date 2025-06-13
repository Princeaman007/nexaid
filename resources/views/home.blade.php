@extends('layouts.app')

@section('content')
<!-- Hero avec image de fond -->
<div style="position: relative; background-image: url('{{ asset('images/stage.jpg') }}'); background-size: cover; background-position: center; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <!-- Overlay sombre -->
    <div
        style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background: rgba(0,0,0,0.6); z-index: 1;">
    </div>

    <!-- Contenu Hero -->
    <div style="position: relative; z-index: 2; color: white; max-width: 800px; padding: 20px;">
        <h1 style="font-size: 3em; margin-bottom: 20px;">
            @if(app()->getLocale() == 'fr')
            Trouvez le Stage International Parfait
            @else
            Find Your Perfect International Internship
            @endif
        </h1>

        <p style="font-size: 1.2em; margin-bottom: 30px;">
            @if(app()->getLocale() == 'fr')
            Connectez-vous à des opportunités exceptionnelles, partout dans le monde.
            @else
            Connect with outstanding opportunities worldwide.
            @endif
        </p>

        <!-- Barre de recherche -->
        <form action="{{ route('internships.index') }}" method="GET"
            style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="q"
                placeholder="@if(app()->getLocale() == 'fr') Rechercher un stage... @else Search for an internship... @endif"
                style="padding: 12px 20px; border: none; border-radius: 4px; width: 60%; max-width: 400px;">
            <button type="submit"
                style="background-color: #007bff; border: none; color: white; padding: 12px 20px; border-radius: 4px; font-weight: bold;">
                @if(app()->getLocale() == 'fr')
                Rechercher
                @else
                Search
                @endif
            </button>
        </form>
    </div>
</div>


<!-- Stages récents -->
<div style="margin-bottom: 40px;">
    <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;">
        @if(app()->getLocale() == 'fr')
        Stages récents
        @else
        Recent Internships
        @endif
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @if(isset($internships) && count($internships))
        @foreach ($internships as $internship)
        <div style="border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden;">
            @if($internship->image)
            <div style="height: 150px; overflow: hidden;">
                <img src="{{ asset('storage/' . $internship->image) }}"
                    alt="{{ $internship->title[app()->getLocale()] ?? '' }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            @endif
            <div style="padding: 20px;">
                <h3 style="margin-top: 0; color: #343a40;">{{ $internship->title[app()->getLocale()] ?? '' }}</h3>

                <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                    @if($internship->location)
                    <span
                        style="background-color: #e9ecef; padding: 5px 10px; border-radius: 20px; font-size: 0.9em; margin-right: 10px; margin-bottom: 5px;">
                        <i class="fas fa-map-marker-alt"></i> {{ $internship->location }}
                    </span>
                    @endif

                    @if($internship->category)
                    <span
                        style="background-color: #e9ecef; padding: 5px 10px; border-radius: 20px; font-size: 0.9em; margin-bottom: 5px;">
                        {{ $internship->category->name[app()->getLocale()] ?? '' }}
                    </span>
                    @endif
                </div>

                <p style="color: #6c757d; margin-bottom: 15px;">{{
                    \Illuminate\Support\Str::limit(strip_tags($internship->description[app()->getLocale()] ?? ''), 100)
                    }}</p>

                <a href="{{ route('internships.show', $internship->slug) }}"
                    style="color: #007bff; text-decoration: none; font-weight: bold;">
                    @if(app()->getLocale() == 'fr')
                    Voir les détails →
                    @else
                    View details →
                    @endif
                </a>
            </div>
        </div>
        @endforeach
        @else
        <div
            style="grid-column: 1 / -1; text-align: center; padding: 30px; background-color: #f8f9fa; border-radius: 5px;">
            <p style="color: #6c757d; margin: 0;">
                @if(app()->getLocale() == 'fr')
                Aucun stage disponible pour le moment.
                @else
                No internships available at the moment.
                @endif
            </p>
        </div>
        @endif
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('internships.index') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">
            @if(app()->getLocale() == 'fr')
            Voir tous les stages →
            @else
            View all internships →
            @endif
        </a>
    </div>
</div>

<!-- Nos services -->
<div style="margin-bottom: 40px;">
    <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;">
        @if(app()->getLocale() == 'fr')
        Nos Services
        @else
        Our Services
        @endif
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
            <div style="font-size: 2em; color: #007bff; margin-bottom: 15px;">🔍</div>
            <h3 style="margin-top: 0; color: #343a40;">
                @if(app()->getLocale() == 'fr')
                Recherche de Stage
                @else
                Internship Search
                @endif
            </h3>
            <p style="color: #6c757d;">
                @if(app()->getLocale() == 'fr')
                Trouvez le stage parfait correspondant à vos compétences et objectifs de carrière.
                @else
                Find the perfect internship matching your skills and career goals.
                @endif
            </p>
            <a href="{{ route('services.internship-search') }}"
                style="color: #007bff; text-decoration: none; font-weight: bold;">
                @if(app()->getLocale() == 'fr')
                En savoir plus →
                @else
                Learn more →
                @endif
            </a>
        </div>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
            <div style="font-size: 2em; color: #007bff; margin-bottom: 15px;">🏠</div>
            <h3 style="margin-top: 0; color: #343a40;">
                @if(app()->getLocale() == 'fr')
                Logement
                @else
                Housing
                @endif
            </h3>
            <p style="color: #6c757d;">
                @if(app()->getLocale() == 'fr')
                Des options de logement sûres et abordables pendant votre stage à l'étranger.
                @else
                Safe and affordable housing options during your internship abroad.
                @endif
            </p>
            <a href="{{ route('services.housing') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">
                @if(app()->getLocale() == 'fr')
                En savoir plus →
                @else
                Learn more →
                @endif
            </a>
        </div>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
            <div style="font-size: 2em; color: #007bff; margin-bottom: 15px;">🗣️</div>
            <h3 style="margin-top: 0; color: #343a40;">
                @if(app()->getLocale() == 'fr')
                Cours de Langue
                @else
                Language Courses
                @endif
            </h3>
            <p style="color: #6c757d;">
                @if(app()->getLocale() == 'fr')
                Améliorez vos compétences linguistiques pour maximiser votre expérience internationale.
                @else
                Improve your language skills to maximize your international experience.
                @endif
            </p>
            <a href="{{ route('services.language-courses') }}"
                style="color: #007bff; text-decoration: none; font-weight: bold;">
                @if(app()->getLocale() == 'fr')
                En savoir plus →
                @else
                Learn more →
                @endif
            </a>
        </div>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
            <div style="font-size: 2em; color: #007bff; margin-bottom: 15px;">✈️</div>
            <h3 style="margin-top: 0; color: #343a40;">
                @if(app()->getLocale() == 'fr')
                Transport Aéroport
                @else
                Airport Pickup
                @endif
            </h3>
            <p style="color: #6c757d;">
                @if(app()->getLocale() == 'fr')
                Arrivez en toute sécurité avec notre service de transport depuis l'aéroport.
                @else
                Arrive safely with our airport pickup service.
                @endif
            </p>
            <a href="{{ route('services.airport-pickup') }}"
                style="color: #007bff; text-decoration: none; font-weight: bold;">
                @if(app()->getLocale() == 'fr')
                En savoir plus →
                @else
                Learn more →
                @endif
            </a>
        </div>
    </div>
</div>

<!-- Articles de blog récents -->
@if(isset($blogs) && count($blogs))
<div style="margin-bottom: 40px;">
    <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;">
        @if(app()->getLocale() == 'fr')
        Articles Récents
        @else
        Recent Articles
        @endif
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @foreach ($blogs as $blog)
        <div style="border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden;">
            @if($blog->image)
            <div style="height: 150px; overflow: hidden;">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title[app()->getLocale()] ?? '' }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            @endif
            <div style="padding: 20px;">
                <h3 style="margin-top: 0; color: #343a40;">{{ $blog->title[app()->getLocale()] ?? '' }}</h3>

                @if($blog->published_at)
                <p style="color: #6c757d; font-size: 0.9em; margin-bottom: 10px;">
                    {{ $blog->published_at->format('d/m/Y') }}
                </p>
                @endif

                <p style="color: #6c757d; margin-bottom: 15px;">{{
                    \Illuminate\Support\Str::limit(strip_tags($blog->content[app()->getLocale()] ?? ''), 100) }}</p>

                <a href="{{ route('blog.show', $blog->slug) }}"
                    style="color: #007bff; text-decoration: none; font-weight: bold;">
                    @if(app()->getLocale() == 'fr')
                    Lire l'article →
                    @else
                    Read article →
                    @endif
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('blog.index') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">
            @if(app()->getLocale() == 'fr')
            Voir tous les articles →
            @else
            View all articles →
            @endif
        </a>
    </div>
</div>
@endif

<!-- Nos partenaires -->
@if(isset($partners) && count($partners))
<div style="margin-bottom: 40px;">
    <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;">
        @if(app()->getLocale() == 'fr')
        Nos Partenaires
        @else
        Our Partners
        @endif
    </h2>

    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; align-items: center;">
        @foreach ($partners as $partner)
        <div style="text-align: center;">
            @if($partner->logo)
            <a href="{{ $partner->website_url ?? '#' }}" target="_blank">
                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name[app()->getLocale()] ?? '' }}"
                    style="max-height: 80px; max-width: 150px;">
            </a>
            @else
            <a href="{{ $partner->website_url ?? '#' }}" target="_blank" style="color: #343a40; text-decoration: none;">
                {{ $partner->name[app()->getLocale()] ?? '' }}
            </a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- CTA finale -->
<div style="background-color: #007bff; color: white; text-align: center; padding: 40px 20px; border-radius: 8px;">
    <h2 style="margin-top: 0; margin-bottom: 20px;">
        @if(app()->getLocale() == 'fr')
        Prêt à commencer votre aventure internationale ?
        @else
        Ready to start your international adventure?
        @endif
    </h2>

    <p style="max-width: 600px; margin: 0 auto 30px auto;">
        @if(app()->getLocale() == 'fr')
        Rejoignez des milliers d'étudiants qui ont transformé leur carrière grâce à nos stages internationaux.
        @else
        Join thousands of students who have transformed their careers through our international internships.
        @endif
    </p>

    <a href="{{ route('internships.index') }}"
        style="background-color: white; color: #007bff; text-decoration: none; padding: 12px 30px; border-radius: 4px; font-size: 1.1em; display: inline-block; font-weight: bold;">
        @if(app()->getLocale() == 'fr')
        Explorer les Opportunités
        @else
        Explore Opportunities
        @endif
    </a>
</div>
@endsection