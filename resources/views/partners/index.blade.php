@extends('layouts.app')

@section('content')

    <h1>
        @if(app()->getLocale() == 'fr')
            Nos Partenaires
        @else
            Our Partners
        @endif
    </h1>

    

    @if($partners->count())
        @foreach ($partners as $partner)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h2>{{ $partner->name[app()->getLocale()] ?? '' }}</h2>
                <p>{{ $partner->description[app()->getLocale()] ?? '' }}</p>
                @if($partner->website_url)
                    <p>
                        <a href="{{ $partner->website_url }}" target="_blank">
                            @if(app()->getLocale() == 'fr')
                                Visiter le site
                            @else
                                Visit website
                            @endif
                        </a>
                    </p>
                @endif
                @if($partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo" style="max-height: 100px;">
                @endif
            </div>
        @endforeach
    @else
        <p>
            @if(app()->getLocale() == 'fr')
                Aucun partenaire disponible pour le moment.
            @else
                No partners available at the moment.
            @endif
        </p>
    @endif

@endsection
