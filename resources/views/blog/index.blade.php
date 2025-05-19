@extends('layouts.app')

@section('content')

    

    @if(session('locale_set'))
        <p style="color: green;">
            Langue bien changée en : {{ session('locale_set') }}
        </p>
    @endif

    <h1>
        @if(app()->getLocale() == 'fr')
            Articles du Blog
        @else
            Blog Posts
        @endif
    </h1>

    @forelse($posts as $post)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2>
                <a href="{{ route('blog.show', $post->slug) }}">
                    {{ $post->title[app()->getLocale()] ?? '' }}
                </a>
            </h2>
            <p>
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content[app()->getLocale()] ?? ''), 150) }}
            </p>
            <small>
                @if(app()->getLocale() == 'fr')
                    Publié le :
                @else
                    Published on :
                @endif
                {{ $post->published_at->format('d/m/Y') }}
            </small>
        </div>
    @empty
        <p>
            @if(app()->getLocale() == 'fr')
                Aucun article disponible.
            @else
                No blog posts available.
            @endif
        </p>
    @endforelse

@endsection
