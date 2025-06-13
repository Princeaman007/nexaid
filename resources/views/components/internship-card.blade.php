<div style="border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden;">
    @if($internship->image)
        <div style="height: 150px; overflow: hidden;">
            <img src="{{ asset('storage/' . $internship->image) }}"
                 alt="{{ $internship->title[app()->getLocale()] ?? '' }}"
                 style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    @endif
    <div style="padding: 20px;">
        <h3 style="margin-top: 0; color: #343a40;">
            {{ $internship->title[app()->getLocale()] ?? '' }}
        </h3>
        <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
            @if($internship->location)
                <span style="...">
                    <i class="fas fa-map-marker-alt"></i> {{ $internship->location }}
                </span>
            @endif
            @if($internship->category)
                <span style="...">
                    {{ $internship->category->name[app()->getLocale()] ?? '' }}
                </span>
            @endif
        </div>
        <p style="color: #6c757d;">
            {{ \Illuminate\Support\Str::limit(strip_tags($internship->description[app()->getLocale()] ?? ''), 100) }}
        </p>
        <a href="{{ route('internships.show', $internship->slug) }}" style="...">
            @lang('Voir les détails →')
        </a>
    </div>
</div>
