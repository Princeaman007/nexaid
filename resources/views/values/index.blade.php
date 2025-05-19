@extends('layouts.app')

@section('content')

    <h1>
        @if(app()->getLocale() == 'fr')
            Nos Valeurs & Missions
        @else
            Our Values & Missions
        @endif
    </h1>

    

    @if($valueMissions->count())
        @foreach ($valueMissions as $valueMission)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h2>{{ $valueMission->title[app()->getLocale()] ?? '' }}</h2>
                <p>{{ $valueMission->description[app()->getLocale()] ?? '' }}</p>
            </div>
        @endforeach
    @else
        <p>
            @if(app()->getLocale() == 'fr')
                Aucune valeur ou mission disponible pour le moment.
            @else
                No values or missions available at the moment.
            @endif
        </p>
    @endif

@endsection
