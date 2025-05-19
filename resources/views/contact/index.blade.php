@extends('layouts.app')

@section('content')

    <h1>
        @if(app()->getLocale() == 'fr')
            Contactez-nous
        @else
            Contact Us
        @endif
    </h1>

    

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}">
        @csrf

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    Nom
                @else
                    Name
                @endif
            </label><br>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    Email
                @else
                    Email
                @endif
            </label><br>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>
                @if(app()->getLocale() == 'fr')
                    Message
                @else
                    Message
                @endif
            </label><br>
            <textarea name="message" required></textarea>
        </div>

        <div>
            <button type="submit">
                @if(app()->getLocale() == 'fr')
                    Envoyer
                @else
                    Send
                @endif
            </button>
        </div>
    </form>

@endsection
