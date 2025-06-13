@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px;">
    <h1 style="margin-bottom: 20px;">
        {{ app()->getLocale() == 'fr' ? 'Liste des stages' : 'Internship List' }}
    </h1>

    @if(session('locale_set'))
    <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

    <!-- FILTRE -->
    <div class="filter-box" style="background-color: #f1f3f5; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <form action="{{ route('internships.index') }}" method="GET">
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <!-- Catégorie -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="category">{{ __('Category') }}</label>
                    <select name="category" id="category" style="width: 100%; padding: 10px; border-radius: 4px;">
                        <option value="">{{ __('All categories') }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                            {{ $category->name[app()->getLocale()] ?? '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lieu -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="location">{{ __('Location') }}</label>
                    <input type="text" name="location" id="location" value="{{ request('location') }}"
                        style="width: 100%; padding: 10px; border-radius: 4px;">
                </div>

                <!-- Mot-clé -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="keyword">{{ __('Keyword') }}</label>
                    <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                        style="width: 100%; padding: 10px; border-radius: 4px;">
                </div>

                <!-- Date de début -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="start_date">{{ __('Start After') }}</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        style="width: 100%; padding: 10px; border-radius: 4px;">
                </div>

                <!-- Tri -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="sort">{{ __('Sort by') }}</label>
                    <select name="sort" id="sort" style="width: 100%; padding: 10px; border-radius: 4px;">
                        <option value="">{{ __('Default') }}</option>
                        <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>
                            {{ __('Newest') }}
                        </option>
                        <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>
                            {{ __('Oldest') }}
                        </option>
                        <option value="duration_asc" {{ request('sort') == 'duration_asc' ? 'selected' : '' }}>
                            {{ __('Shortest duration') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Boutons -->
            <div style="margin-top: 15px;">
                <button type="submit"
                    style="background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px;">
                    {{ __('Filter') }}
                </button>
                <a href="{{ route('internships.index') }}"
                    style="margin-left: 10px; color: #fff; background-color: #6c757d; padding: 10px 20px; border-radius: 5px;">
                    {{ __('Reset') }}
                </a>
            </div>
        </form>
    </div>

    @if($internships->count())
    <!-- Compteur de résultats -->
    <p style="color: #6c757d; margin-bottom: 20px;">
        {{ $internships->total() }} {{ __('internships found') }}
    </p>

    <!-- LISTE DES STAGES -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @foreach ($internships as $internship)
        <div style="border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; background: white;">
            @if($internship->image)
            <div style="height: 150px; overflow: hidden;">
                <img src="{{ asset('storage/' . $internship->image) }}"
                    alt="{{ $internship->title[app()->getLocale()] ?? '' }}"
                    style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
            </div>
            @endif
            <div style="padding: 20px;">
                <h2 style="margin-top: 0; display: flex; align-items: center; gap: 8px;">
                    <a href="{{ route('internships.show', $internship->slug) }}"
                        style="color: #007bff; text-decoration: none;">
                        {{ $internship->title[app()->getLocale()] ?? '' }}
                    </a>

                    {{-- Badge "Nouveau" si créé il y a moins de 7 jours --}}
                    @if(\Carbon\Carbon::parse($internship->created_at)->gt(now()->subDays(7)))
                    <span style="background-color: #28a745; color: white; padding: 3px 7px; border-radius: 4px; font-size: 0.75em;">
                        🔥 {{ __('New') }}
                    </span>
                    @endif
                </h2>

                <div
                    style="font-size: 0.9em; margin-bottom: 10px; color: #495057; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                    @if($internship->category)
                    <span
                        style="background-color: #f8f9fa; padding: 4px 12px; border-radius: 6px; font-weight: 500; border: 1px solid #dee2e6;">
                        {{ $internship->category->name[app()->getLocale()] ?? '' }}
                    </span>
                    @endif

                    @if($internship->location)
                    <span style="display: flex; align-items: center; gap: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#6c757d"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 0a5 5 0 0 0-5 5c0 4.418 5 11 5 11s5-6.582 5-11a5 5 0 0 0-5-5Zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" />
                        </svg>
                        {{ $internship->location }}
                    </span>
                    @endif
                </div>

                {{-- Infos supplémentaires --}}
                @if($internship->start_date || $internship->end_date)
                <p style="color: #6c757d; font-size: 0.9em; margin-bottom: 5px;">
                    📅
                    {{ __('From') }} {{ \Carbon\Carbon::parse($internship->start_date)->translatedFormat('d M Y') ?? '' }}
                    {{ __('to') }} {{ \Carbon\Carbon::parse($internship->end_date)->translatedFormat('d M Y') ?? '' }}
                </p>
                @endif

                @if($internship->duration)
                <p style="color: #6c757d; font-size: 0.9em; margin-bottom: 5px;">
                    🕒 {{ __('Duration') }}: {{ $internship->duration }}
                </p>
                @endif

                @if($internship->company)
                <p style="color: #6c757d; font-size: 0.9em; margin-bottom: 5px;">
                    🏢 {{ __('Company') }}: {{ $internship->company->name }}
                </p>
                @endif

                @if($internship->skills)
                <p style="color: #6c757d; font-size: 0.9em; margin-bottom: 5px;">
                    🧠 {{ __('Skills') }}:
                    @if(is_array($internship->skills))
                    {{ implode(', ', $internship->skills) }}
                    @else
                    {{ $internship->skills }}
                    @endif
                </p>
                @endif

                <p style="color: #495057;">
                    {{ \Illuminate\Support\Str::limit(strip_tags($internship->description[app()->getLocale()] ?? ''), 150) }}
                </p>

                <div style="margin-top: 10px; text-align: right;">
                    <a href="{{ route('internships.show', $internship->slug) }}"
                        style="background-color: #007bff; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
                        {{ __('View details') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div style="margin-top: 30px;">
        {{ $internships->appends(request()->query())->links() }}
    </div>
    @else
    <p style="text-align: center; color: #6c757d; padding: 30px;">
        {{ __('No internships available matching your criteria.') }}
    </p>
    @endif
</div>
@endsection
