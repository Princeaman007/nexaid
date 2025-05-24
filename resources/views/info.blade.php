@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        <h1 style="text-align: center; margin-bottom: 30px;">
            @if(app()->getLocale() == 'fr')
                Informations Générales
            @else
                General Information
            @endif
        </h1>

        <!-- Section FAQ -->
        <section id="faq" style="margin-bottom: 50px;">
            <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                @if(app()->getLocale() == 'fr')
                    Foire Aux Questions
                @else
                    Frequently Asked Questions
                @endif
            </h2>
            
            <div class="accordion" style="margin-top: 20px;">
                @forelse($faqs as $faq)
                    <div style="margin-bottom: 15px; border: 1px solid #dee2e6; border-radius: 5px; overflow: hidden;">
                        <div style="background-color: #f8f9fa; padding: 15px; cursor: pointer;" onclick="toggleAccordion(this)">
                            <strong>{{ $faq->question[app()->getLocale()] ?? '' }}</strong>
                            <span style="float: right;">+</span>
                        </div>
                        <div style="padding: 15px; display: none;">
                            <p>{{ $faq->answer[app()->getLocale()] ?? '' }}</p>
                        </div>
                    </div>
                @empty
                    <p>
                        @if(app()->getLocale() == 'fr')
                            Aucune question fréquente disponible pour le moment.
                        @else
                            No frequently asked questions available at the moment.
                        @endif
                    </p>
                @endforelse
            </div>
        </section>
        
        <!-- Section Valeurs et Mission -->
        <section id="values-mission" style="margin-bottom: 50px;">
            <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                @if(app()->getLocale() == 'fr')
                    Nos Valeurs et Notre Mission
                @else
                    Our Values and Mission
                @endif
            </h2>
            
            <div style="margin-top: 20px;">
                @if($valueMissions->isNotEmpty())
                    @foreach($valueMissions as $valueMission)
                        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                            <h3 style="color: #007bff;">{{ $valueMission->title[app()->getLocale()] ?? '' }}</h3>
                            <p>{{ $valueMission->description[app()->getLocale()] ?? '' }}</p>
                        </div>
                    @endforeach
                @else
                    @if(app()->getLocale() == 'fr')
                        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                            <h3 style="color: #007bff;">Notre Mission</h3>
                            <p>Notre mission est de faciliter la mobilité internationale des jeunes talents en leur offrant des opportunités de stages significatives à l'étranger. Nous croyons que l'expérience internationale est un facteur clé de développement personnel et professionnel qui prépare les jeunes à relever les défis d'un monde globalisé.</p>
                        </div>
                        
                        <h3 style="color: #343a40; margin-top: 30px;">Nos Valeurs</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 15px;">
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Excellence</h4>
                                <p style="margin-bottom: 0;">Nous nous efforçons d'offrir des services de la plus haute qualité, en veillant à ce que chaque étape de votre parcours soit soigneusement planifiée et exécutée.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Intégrité</h4>
                                <p style="margin-bottom: 0;">Nous agissons avec honnêteté et transparence dans toutes nos interactions, en respectant nos engagements et en fournissant des informations claires et précises.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Diversité</h4>
                                <p style="margin-bottom: 0;">Nous valorisons et célébrons la diversité sous toutes ses formes, en créant un environnement inclusif où chacun peut s'épanouir et apporter sa contribution unique.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Innovation</h4>
                                <p style="margin-bottom: 0;">Nous cherchons constamment à améliorer nos services et à adopter de nouvelles approches pour mieux répondre aux besoins en évolution de nos stagiaires et entreprises partenaires.</p>
                            </div>
                        </div>
                    @else
                        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                            <h3 style="color: #007bff;">Our Mission</h3>
                            <p>Our mission is to facilitate international mobility for young talent by offering meaningful internship opportunities abroad. We believe that international experience is a key factor in personal and professional development that prepares young people to meet the challenges of a globalized world.</p>
                        </div>
                        
                        <h3 style="color: #343a40; margin-top: 30px;">Our Values</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 15px;">
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Excellence</h4>
                                <p style="margin-bottom: 0;">We strive to provide services of the highest quality, ensuring that every step of your journey is carefully planned and executed.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Integrity</h4>
                                <p style="margin-bottom: 0;">We act with honesty and transparency in all our interactions, honoring our commitments and providing clear and accurate information.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Diversity</h4>
                                <p style="margin-bottom: 0;">We value and celebrate diversity in all its forms, creating an inclusive environment where everyone can thrive and make their unique contribution.</p>
                            </div>
                            
                            <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                <h4 style="color: #007bff; margin-top: 0;">Innovation</h4>
                                <p style="margin-bottom: 0;">We constantly seek to improve our services and adopt new approaches to better meet the evolving needs of our interns and partner companies.</p>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </section>
        
        <!-- Section Étapes du Processus -->
        <section id="process" style="margin-bottom: 50px;">
            <h2 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                @if(app()->getLocale() == 'fr')
                    Les Étapes du Processus
                @else
                    The Process Steps
                @endif
            </h2>
            
            <div style="margin-top: 30px;">
                @if(app()->getLocale() == 'fr')
                    <div class="process-timeline">
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">1</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Inscription et Évaluation</h3>
                                <p>Créez votre profil en ligne et soumettez votre CV. Notre équipe évaluera vos compétences, objectifs et préférences pour identifier les opportunités qui vous correspondent le mieux.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">2</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Proposition de Stages</h3>
                                <p>Nous vous proposons une sélection d'offres de stage adaptées à votre profil. Vous pouvez également parcourir notre base de données d'offres et postuler à celles qui vous intéressent.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">3</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Entretiens et Sélection</h3>
                                <p>Nous vous aidons à préparer vos entretiens avec les entreprises. Après les entretiens, nous facilitons le processus de sélection et vous tenons informé de votre candidature.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">4</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Préparation au Départ</h3>
                                <p>Une fois votre stage confirmé, nous vous aidons à préparer votre départ avec des services pour le visa, le logement, les cours de langue et autres besoins pratiques.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">5</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Suivi et Support</h3>
                                <p>Pendant toute la durée de votre stage, notre équipe reste disponible pour vous accompagner et vous offrir un support continu pour assurer une expérience réussie.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="process-timeline">
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">1</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Registration and Assessment</h3>
                                <p>Create your online profile and submit your resume. Our team will assess your skills, goals, and preferences to identify opportunities that best match your profile.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">2</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Internship Proposals</h3>
                                <p>We provide you with a selection of internship offers tailored to your profile. You can also browse our database of offers and apply to those that interest you.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">3</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Interviews and Selection</h3>
                                <p>We help you prepare for your interviews with companies. After the interviews, we facilitate the selection process and keep you informed about your application.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 30px;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">4</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Departure Preparation</h3>
                                <p>Once your internship is confirmed, we help you prepare for departure with services for visa, accommodation, language courses, and other practical needs.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex;">
                            <div style="width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2em; flex-shrink: 0;">5</div>
                            <div style="margin-left: 20px;">
                                <h3 style="margin-top: 0; color: #343a40;">Follow-up and Support</h3>
                                <p>Throughout your internship, our team remains available to accompany you and offer continuous support to ensure a successful experience.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        
        <!-- CTA finale -->
        <div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
            <a href="{{ route('internships.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 12px 30px; border-radius: 4px; font-size: 1.1em; display: inline-block;">
                @if(app()->getLocale() == 'fr')
                    Explorer les Stages Disponibles
                @else
                    Explore Available Internships
                @endif
            </a>
        </div>
    </div>

    <script>
        function toggleAccordion(element) {
            // Change le symbole + en - et vice versa
            const symbol = element.querySelector('span');
            symbol.textContent = symbol.textContent === '+' ? '-' : '+';
            
            // Affiche ou masque le contenu
            const content = element.nextElementSibling;
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection