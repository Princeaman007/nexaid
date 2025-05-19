@extends('layouts.app')

@section('content')



    @if(session('locale_set'))
        <p style="color: green;">
            Langue bien changée en : {{ session('locale_set') }}
        </p>
    @endif

    <h1>{{ $post->title[app()->getLocale()] ?? '' }}</h1>

    <p>
        <small>
            @if(app()->getLocale() == 'fr')
                Publié le :
            @else
                Published on :
            @endif
            {{ $post->published_at->format('d/m/Y') }}
        </small>
    </p>

    <div>
        {!! $post->content[app()->getLocale()] ?? '' !!}
    </div>

    <hr>
    <a href="{{ route('blog.index') }}">
        @if(app()->getLocale() == 'fr')
            ← Retour au blog
        @else
            ← Back to blog
        @endif
    </a>

@endsection
