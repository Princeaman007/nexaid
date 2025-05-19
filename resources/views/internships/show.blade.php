@extends('layouts.app')

@section('content')

    

    {{-- Message flash si la langue vient d’être changée --}}
    @if(session('locale_set'))
        <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

    <h1>{{ $internship->title[app()->getLocale()] ?? '' }}</h1>

    <p><strong>
        @if(app()->getLocale() == 'fr')
            Description :
        @else
            Description:
        @endif
    </strong></p>
    <p>{{ $internship->description[app()->getLocale()] ?? '' }}</p>

    <p><strong>
        @if(app()->getLocale() == 'fr')
            Lieu :
        @else
            Location:
        @endif
    </strong> {{ $internship->location }}</p>

    <p><strong>
        @if(app()->getLocale() == 'fr')
            Entreprise :
        @else
            Company:
        @endif
    </strong> {{ $internship->company_name }}</p>

    @if($internship->image)
        <img src="{{ asset('storage/' . $internship->image) }}" alt="Image" style="max-width:300px;">
    @endif

    <p>
        <a href="{{ route('internships.apply', $internship->id) }}">
            @if(app()->getLocale() == 'fr')
                Postuler à ce stage
            @else
                Apply for this internship
            @endif
        </a>
    </p>

    <p><a href="{{ route('internships.index') }}">
        @if(app()->getLocale() == 'fr')
            Retour à la liste
        @else
            Back to list
        @endif
    </a></p>

@endsection
