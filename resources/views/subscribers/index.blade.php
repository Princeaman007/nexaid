@extends('layouts.app')

@section('content')

    <h1>
        @if(app()->getLocale() == 'fr')
            Questions des abonnés
        @else
            Subscribers' Questions
        @endif
    </h1>

   

    @if($subscribers->count())
        @foreach ($subscribers as $subscriber)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h2>
                    {{ $subscriber->question[app()->getLocale()] ?? '' }}
                </h2>
                <p>
                    {{ $subscriber->answer[app()->getLocale()] ?? '' }}
                </p>
            </div>
        @endforeach
    @else
        <p>
            @if(app()->getLocale() == 'fr')
                Aucune question pour le moment.
            @else
                No questions at the moment.
            @endif
        </p>
    @endif

@endsection
