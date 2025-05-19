@extends('layouts.app')

@section('content')

   

    {{-- Message flash si la langue vient d’être changée --}}
    @if(session('locale_set'))
        <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

    <h1>
        @if(app()->getLocale() == 'fr')
            Liste des stages
        @else
            Internship List
        @endif
    </h1>

    @if($internships->count())
        @foreach ($internships as $internship)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h2>
                    <a href="{{ route('internships.show', $internship->slug) }}">
                        {{ $internship->title[app()->getLocale()] ?? '' }}
                    </a>
                </h2>
                <p>{{ $internship->description[app()->getLocale()] ?? '' }}</p>
            </div>
        @endforeach
    @else
        <p>
            @if(app()->getLocale() == 'fr')
                Aucun stage disponible actuellement.
            @else
                No internships available at the moment.
            @endif
        </p>
    @endif

@endsection
