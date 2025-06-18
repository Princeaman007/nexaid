@extends('layouts.app')

@section('content')
<div class="faq-container">
    <div class="faq-header">
        <h1 class="faq-title">
            @if(app()->getLocale() == 'fr')
                Foire Aux Questions
            @else
                Frequently Asked Questions
            @endif
        </h1>
        <div class="faq-subtitle">
            @if(app()->getLocale() == 'fr')
                Trouvez rapidement les réponses à vos questions les plus fréquentes
            @else
                Find quick answers to your most frequently asked questions
            @endif
        </div>
    </div>

    @if($faqs->count())
        <div class="faq-search">
            <div class="search-container">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" 
                       id="faq-search" 
                       placeholder="@if(app()->getLocale() == 'fr')Rechercher une question...@elseSearch for a question...@endif"
                       class="search-input">
            </div>
        </div>

        <div class="faq-stats">
            <span class="stats-text">
                @if(app()->getLocale() == 'fr')
                    {{ $faqs->count() }} {{ $faqs->count() > 1 ? 'questions' : 'question' }} disponible{{ $faqs->count() > 1 ? 's' : '' }}
                @else
                    {{ $faqs->count() }} question{{ $faqs->count() > 1 ? 's' : '' }} available
                @endif
            </span>
        </div>

        <div class="faq-accordion">
            @foreach ($faqs as $index => $faq)
                <div class="faq-item" data-faq-item>
                    <div class="faq-question" data-faq-toggle>
                        <h2 class="question-text">
                            {{ $faq->getTranslation('question', app()->getLocale()) }}
                        </h2>
                        <div class="question-icon">
                            <svg class="plus-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <svg class="minus-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="faq-answer" data-faq-content>
                        <div class="answer-content">
                            <p class="answer-text">
                                {{ $faq->getTranslation('answer', app()->getLocale()) }}
                            </p>
                            <div class="answer-actions">
                                <button class="helpful-btn" data-helpful="yes">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
                                    </svg>
                                    @if(app()->getLocale() == 'fr')
                                        Utile
                                    @else
                                        Helpful
                                    @endif
                                </button>
                                <button class="helpful-btn" data-helpful="no">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/>
                                    </svg>
                                    @if(app()->getLocale() == 'fr')
                                        Pas utile
                                    @else
                                        Not helpful
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="faq-contact">
            <div class="contact-card">
                <h3 class="contact-title">
                    @if(app()->getLocale() == 'fr')
                        Vous ne trouvez pas votre réponse ?
                    @else
                        Can't find your answer?
                    @endif
                </h3>
                <p class="contact-text">
                    @if(app()->getLocale() == 'fr')
                        Notre équipe est là pour vous aider. N'hésitez pas à nous contacter directement.
                    @else
                        Our team is here to help. Don't hesitate to contact us directly.
                    @endif
                </p>
                <a href="#" class="contact-button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    @if(app()->getLocale() == 'fr')
                        Nous contacter
                    @else
                        Contact us
                    @endif
                </a>
            </div>
        </div>
    @else
        <div class="no-faqs">
            <div class="no-faqs-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                    <point cx="12" cy="17"/>
                </svg>
            </div>
            <h3>
                @if(app()->getLocale() == 'fr')
                    Aucune question disponible
                @else
                    No questions available
                @endif
            </h3>
            <p>
                @if(app()->getLocale() == 'fr')
                    Les questions fréquemment posées seront bientôt disponibles.
                @else
                    Frequently asked questions will be available soon.
                @endif
            </p>
        </div>
    @endif
</div>

<style>
.faq-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.faq-header {
    text-align: center;
    margin-bottom: 3rem;
}

.faq-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.faq-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.faq-search {
    margin-bottom: 2rem;
}

.search-container {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.search-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.faq-stats {
    text-align: center;
    margin-bottom: 2rem;
}

.stats-text {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

.faq-accordion {
    margin-bottom: 3rem;
}

.faq-item {
    background: white;
    border-radius: 12px;
    margin-bottom: 1rem;
    border: 1px solid #e9ecef;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.faq-item.active {
    border-color: #667eea;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
}

.faq-question {
    padding: 1.5rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.faq-question:hover {
    background: #f8f9fa;
}

.faq-item.active .faq-question {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.question-text {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    flex-grow: 1;
    padding-right: 1rem;
    line-height: 1.4;
}

.question-icon {
    width: 24px;
    height: 24px;
    position: relative;
    flex-shrink: 0;
}

.plus-icon,
.minus-icon {
    position: absolute;
    top: 0;
    left: 0;
    transition: all 0.3s ease;
}

.plus-icon {
    opacity: 1;
    transform: rotate(0deg);
}

.minus-icon {
    opacity: 0;
    transform: rotate(90deg);
}

.faq-item.active .plus-icon {
    opacity: 0;
    transform: rotate(90deg);
}

.faq-item.active .minus-icon {
    opacity: 1;
    transform: rotate(0deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.faq-item.active .faq-answer {
    max-height: 500px;
}

.answer-content {
    padding: 0 1.5rem 1.5rem;
    border-top: 1px solid #f0f0f0;
}

.answer-text {
    color: #495057;
    line-height: 1.7;
    margin: 1rem 0;
    font-size: 1rem;
}

.answer-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
}

.helpful-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border: 1px solid #dee2e6;
    background: white;
    color: #6c757d;
    border-radius: 8px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.helpful-btn:hover {
    color: #667eea;
    border-color: #667eea;
}

.helpful-btn.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.faq-contact {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
}

.contact-card {
    max-width: 500px;
    margin: 0 auto;
}

.contact-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.contact-text {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.contact-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.contact-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.no-faqs {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.no-faqs-icon {
    margin-bottom: 2rem;
    color: #adb5bd;
}

.no-faqs h3 {
    font-size: 1.5rem;
    color: #495057;
    margin-bottom: 1rem;
}

.no-faqs p {
    font-size: 1.1rem;
    max-width: 400px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 768px) {
    .faq-container {
        padding: 1rem;
    }
    
    .faq-title {
        font-size: 2rem;
    }
    
    .faq-subtitle {
        font-size: 1rem;
    }
    
    .faq-question {
        padding: 1.25rem;
    }
    
    .question-text {
        font-size: 1rem;
    }
    
    .answer-content {
        padding: 0 1.25rem 1.25rem;
    }
    
    .answer-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .faq-contact {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .faq-title {
        font-size: 1.75rem;
    }
    
    .faq-question {
        padding: 1rem;
    }
    
    .answer-content {
        padding: 0 1rem 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Accordion functionality
    const faqToggles = document.querySelectorAll('[data-faq-toggle]');
    
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const faqItem = this.closest('[data-faq-item]');
            const isActive = faqItem.classList.contains('active');
            
            // Close all other items
            document.querySelectorAll('[data-faq-item]').forEach(item => {
                item.classList.remove('active');
            });
            
            // Toggle current item
            if (!isActive) {
                faqItem.classList.add('active');
            }
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('faq-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('[data-faq-item]');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.question-text').textContent.toLowerCase();
                const answer = item.querySelector('.answer-text').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Helpful buttons
    const helpfulBtns = document.querySelectorAll('.helpful-btn');
    helpfulBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const isHelpful = this.dataset.helpful === 'yes';
            const siblingBtn = this.parentNode.querySelector(`[data-helpful="${isHelpful ? 'no' : 'yes'}"]`);
            
            // Toggle active state
            this.classList.toggle('active');
            siblingBtn.classList.remove('active');
            
            // You can add AJAX call here to save feedback
            console.log(`Feedback: ${this.dataset.helpful}`);
        });
    });
});
</script>
@endsection