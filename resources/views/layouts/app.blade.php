<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>Site Web</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        nav a {
            margin-right: 10px;
        }

        .language-switcher {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    @if(View::hasSection('language-switcher'))
    <div class="language-switcher">
        <a href="{{ url('lang/fr') }}">Français</a> |
        <a href="{{ url('lang/en') }}">English</a>
    </div>
    @endif


    <nav>
        <a href="{{ route('home') }}">@lang('Accueil')</a> |
        <a href="{{ route('internships.index') }}">@lang('Stages')</a> |
        <a href="{{ route('blog.index') }}">@lang('Blog')</a> |
        <a href="{{ route('partners.index') }}">@lang('Partenaires')</a> |
        <a href="{{ route('values.index') }}">@lang('Valeurs & Missions')</a> |
        <a href="{{ route('info') }}">@lang('FAQ')</a> |
        <a href="{{ route('contact.index') }}">@lang('Contact')</a>
    </nav>

    <hr>

    {{-- Affiche un message flash pour le changement de langue --}}
    @if(session('locale_set'))
    <p style="color: green;">Langue changée en : {{ session('locale_set') }}</p>
    @endif

    @yield('content')

</body>

</html>