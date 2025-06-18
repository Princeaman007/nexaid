@extends('layouts.app')

@section('content')
<div class="values-container">
    <div class="values-header">
        <h1 class="values-title">
            @if(app()->getLocale() == 'fr')
                Nos Valeurs & Missions
            @else
                Our Values & Missions
            @endif
        </h1>
        <div class="values-subtitle">
            @if(app()->getLocale() == 'fr')
                Les principes qui guident notre action au quotidien
            @else
                The principles that guide our daily actions
            @endif
        </div>
    </div>

    @if($valueMissions->count())
        <div class="values-grid">
            @foreach ($valueMissions as $index => $valueMission)
                <div class="value-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="value-icon">
                        @if($index % 4 == 0)
                            <!-- Icône Mission -->
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        @elseif($index % 4 == 1)
                            <!-- Icône Valeur -->
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        @elseif($index % 4 == 2)
                            <!-- Icône Engagement -->
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        @else
                            <!-- Icône Innovation -->
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @endif
                    </div>
                    
                    <div class="value-content">
                        <h2 class="value-title">
                            {{ $valueMission->getTranslation('title', app()->getLocale()) }}
                        </h2>
                        
                        <p class="value-description">
                            {{ $valueMission->getTranslation('description', app()->getLocale()) }}
                        </p>
                    </div>
                    
                    <div class="value-number">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-values">
            <div class="no-values-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <h3>
                @if(app()->getLocale() == 'fr')
                    Aucune valeur ou mission disponible
                @else
                    No values or missions available
                @endif
            </h3>
            <p>
                @if(app()->getLocale() == 'fr')
                    Nos valeurs seront bientôt disponibles. Revenez prochainement pour découvrir ce qui nous guide.
                @else
                    Our values will be available soon. Come back later to discover what guides us.
                @endif
            </p>
        </div>
    @endif
</div>

<style>
.values-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.values-header {
    text-align: center;
    margin-bottom: 4rem;
}

.values-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.values-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.value-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.value-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.value-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.value-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.value-content {
    flex-grow: 1;
}

.value-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.value-description {
    color: #6c757d;
    line-height: 1.7;
    font-size: 1rem;
    margin: 0;
}

.value-number {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    font-size: 2rem;
    font-weight: 700;
    color: #e9ecef;
    font-family: 'Georgia', serif;
}

.no-values {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.no-values-icon {
    margin-bottom: 2rem;
    color: #adb5bd;
}

.no-values h3 {
    font-size: 1.5rem;
    color: #495057;
    margin-bottom: 1rem;
}

.no-values p {
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.value-card {
    animation: fadeInUp 0.6s ease-out;
}

.value-card:nth-child(1) { animation-delay: 0.1s; }
.value-card:nth-child(2) { animation-delay: 0.2s; }
.value-card:nth-child(3) { animation-delay: 0.3s; }
.value-card:nth-child(4) { animation-delay: 0.4s; }
.value-card:nth-child(5) { animation-delay: 0.5s; }
.value-card:nth-child(6) { animation-delay: 0.6s; }

/* Responsive */
@media (max-width: 768px) {
    .values-container {
        padding: 1rem;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .values-title {
        font-size: 2rem;
    }
    
    .values-subtitle {
        font-size: 1rem;
    }
    
    .value-card {
        padding: 1.5rem;
    }
    
    .value-icon {
        width: 60px;
        height: 60px;
    }
    
    .value-title {
        font-size: 1.2rem;
    }
    
    .value-number {
        font-size: 1.5rem;
        top: 1rem;
        right: 1rem;
    }
}

@media (max-width: 480px) {
    .values-title {
        font-size: 1.75rem;
    }
    
    .value-card {
        padding: 1.25rem;
    }
    
    .value-icon {
        width: 50px;
        height: 50px;
    }
}
</style>
@endsection