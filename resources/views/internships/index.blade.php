@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Liste des stages
        @else
            Internship List
        @endif
    </h1>

    {{-- Message flash si la langue vient d'être changée --}}
    @if(session('locale_set'))
        <p style="color: green;">Langue bien changée en : {{ session('locale_set') }}</p>
    @endif

    <!-- Formulaire de filtrage -->
    <div class="filter-box" style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
        <h3>
            @if(app()->getLocale() == 'fr')
                Filtrer les stages
            @else
                Filter Internships
            @endif
        </h3>
        
        <form action="{{ route('internships.index') }}" method="GET">
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
                <!-- Filtre par catégorie -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="category">
                        @if(app()->getLocale() == 'fr')
                            Catégorie
                        @else
                            Category
                        @endif
                    </label>
                    <select id="category" name="category" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ced4da;">
                        <option value="">
                            @if(app()->getLocale() == 'fr')
                                Toutes les catégories
                            @else
                                All categories
                            @endif
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name[app()->getLocale()] ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Filtre par lieu -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="location">
                        @if(app()->getLocale() == 'fr')
                            Lieu
                        @else
                            Location
                        @endif
                    </label>
                    <input type="text" id="location" name="location" value="{{ request('location') }}" 
                           style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ced4da;">
                </div>
                
                <!-- Recherche par mot-clé -->
                <div style="flex: 1; min-width: 200px;">
                    <label for="keyword">
                        @if(app()->getLocale() == 'fr')
                            Mot-clé
                        @else
                            Keyword
                        @endif
                    </label>
                    <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}" 
                           style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ced4da;">
                </div>
            </div>
            
            <!-- Boutons d'action -->
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                    @if(app()->getLocale() == 'fr')
                        Filtrer
                    @else
                        Filter
                    @endif
                </button>
                
                <a href="{{ route('internships.index') }}" style="background-color: #6c757d; color: white; border: none; padding: 8px 15px; border-radius: 4px; text-decoration: none;">
                    @if(app()->getLocale() == 'fr')
                        Réinitialiser
                    @else
                        Reset
                    @endif
                </a>
            </div>
        </form>
    </div>

    <!-- Liste des stages -->
    @if($internships->count())
        <div class="internship-list">
            @foreach ($internships as $internship)
                <div style="border:1px solid #ccc; padding:20px; margin-bottom:20px; border-radius: 5px;">
                    <h2>
                        <a href="{{ route('internships.show', $internship->slug) }}" style="color: #007bff; text-decoration: none;">
                            {{ $internship->title[app()->getLocale()] ?? '' }}
                        </a>
                    </h2>
                    
                    <!-- Informations sur le stage -->
                    <div style="margin-bottom: 15px;">
                        @if($internship->category)
                            <span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 20px; font-size: 0.9em; margin-right: 10px;">
                                {{ $internship->category->name[app()->getLocale()] ?? '' }}
                            </span>
                        @endif
                        
                        @if($internship->location)
                            <span style="color: #6c757d; margin-right: 10px;">
                                <strong>
                                    @if(app()->getLocale() == 'fr')
                                        Lieu:
                                    @else
                                        Location:
                                    @endif
                                </strong> 
                                {{ $internship->location }}
                            </span>
                        @endif
                        
                        @if($internship->company_name)
                            <span style="color: #6c757d;">
                                <strong>
                                    @if(app()->getLocale() == 'fr')
                                        Entreprise:
                                    @else
                                        Company:
                                    @endif
                                </strong> 
                                {{ $internship->company_name }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Description courte -->
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($internship->description[app()->getLocale()] ?? ''), 200) }}</p>
                    
                    <!-- Bouton pour voir plus -->
                    <div style="text-align: right;">
                        <a href="{{ route('internships.show', $internship->slug) }}" style="background-color: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 4px; text-decoration: none; display: inline-block;">
                            @if(app()->getLocale() == 'fr')
                                Voir le détail
                            @else
                                View details
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 20px;">
            {{ $internships->appends(request()->query())->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 30px; background-color: #f8f9fa; border-radius: 5px;">
            <p style="font-size: 1.2em; color: #6c757d;">
                @if(app()->getLocale() == 'fr')
                    Aucun stage disponible correspondant à vos critères.
                @else
                    No internships available matching your criteria.
                @endif
            </p>
        </div>
    @endif
@endsection