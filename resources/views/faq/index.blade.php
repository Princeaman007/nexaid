@extends('layouts.app')

@section('content')

    <h1>
        @if(app()->getLocale() == 'fr')
            Foire Aux Questions
        @else
            Frequently Asked Questions
        @endif
    </h1>

   

    @foreach ($faqs as $faq)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2>{{ $faq->question[app()->getLocale()] ?? '' }}</h2>
            <p>{{ $faq->answer[app()->getLocale()] ?? '' }}</p>
        </div>
    @endforeach

@endsection
