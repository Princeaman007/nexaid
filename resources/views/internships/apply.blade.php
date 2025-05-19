@extends('layouts.app')

@section('content')

    

    {{-- Message flash si la langue vient d’être changée --}}
    @if(session('locale_set'))
        <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

    <h1>
        @if(app()->getLocale() == 'fr')
            Postuler pour :
        @else
            Apply for :
        @endif
        {{ $internship->title[app()->getLocale()] ?? '' }}
    </h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('internships.apply.submit', $internship->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    Nom complet :
                @else
                    Full Name:
                @endif
            </label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    Email :
                @else
                    Email:
                @endif
            </label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    CV (PDF) :
                @else
                    CV (PDF):
                @endif
            </label><br>
            <input type="file" name="cv" required>
        </div>

        <button type="submit">
            @if(app()->getLocale() == 'fr')
                Envoyer la candidature
            @else
                Submit Application
            @endif
        </button>
    </form>

    <p><a href="{{ route('internships.show', $internship->slug) }}">
        @if(app()->getLocale() == 'fr')
            Retour à l’offre
        @else
            Back to the offer
        @endif
    </a></p>

@endsection
