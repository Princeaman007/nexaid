@extends('layouts.app')

@section('content')

   

    <h1>
        @if(app()->getLocale() == 'fr')
            Bienvenue sur le site
        @else
            Welcome to the site
        @endif
    </h1>

    {{-- Message flash si la langue vient d’être changée --}}
    @if(session('locale_set'))
        <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

   

    {{-- Affichage des stages récents (exemple) --}}
    <h2>
        @if(app()->getLocale() == 'fr')
            Stages récents
        @else
            Recent Internships
        @endif
    </h2>

    @if(isset($internships) && count($internships))
        @foreach ($internships as $internship)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3>{{ $internship->title[app()->getLocale()] ?? '' }}</h3>
                <p>{{ $internship->description[app()->getLocale()] ?? '' }}</p>
            </div>
        @endforeach
    @else
        <p>
            @if(app()->getLocale() == 'fr')
                Aucun stage disponible pour le moment.
            @else
                No internships available at the moment.
            @endif
        </p>
    @endif

@endsection
