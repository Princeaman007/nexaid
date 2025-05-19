<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Internships</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .language-switcher {
            margin-bottom: 20px;
        }
        .internship {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="language-switcher">
        <a href="{{ url('lang/fr') }}">Français</a> |
        <a href="{{ url('lang/en') }}">English</a>
    </div>

    {{-- Affiche la langue active --}}
    <p>Langue active : {{ app()->getLocale() }}</p>

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

    @foreach ($internships as $internship)
        <div class="internship">
            <h2>{{ $internship->title[app()->getLocale()] ?? '' }}</h2>
            <p>{{ $internship->description[app()->getLocale()] ?? '' }}</p>
        </div>
    @endforeach

    <p>Session ID : {{ session()->getId() }}</p>


</body>
</html>
