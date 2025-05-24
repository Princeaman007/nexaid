@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Cours de Langues
        @else
            Language Courses
        @endif
    </h1>

    <div class="service-description" style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        @if(app()->getLocale() == 'fr')
            <p>Améliorez vos compétences linguistiques avec nos cours de langues adaptés à votre niveau et à vos objectifs. Nous proposons des cours dans plusieurs langues pour vous aider à vous intégrer et à réussir dans votre environnement de stage international.</p>
            
            <h2>Langues disponibles</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Anglais</h3>
                    <p>Tous niveaux disponibles</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Espagnol</h3>
                    <p>Tous niveaux disponibles</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Allemand</h3>
                    <p>Tous niveaux disponibles</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Italien</h3>
                    <p>Tous niveaux disponibles</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Français</h3>
                    <p>Tous niveaux disponibles</p>
                </div>
            </div>
            
            <h2>Formats de cours</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Cours intensifs</h3>
                    <p>20 heures par semaine pour progresser rapidement avant ou pendant votre stage.</p>
                    <p><strong>À partir de :</strong> 200€/semaine</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Cours réguliers</h3>
                    <p>4-6 heures par semaine, compatibles avec votre emploi du temps de stage.</p>
                    <p><strong>À partir de :</strong> 80€/semaine</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Cours particuliers</h3>
                    <p>Cours individuels adaptés à vos besoins spécifiques et à votre rythme.</p>
                    <p><strong>À partir de :</strong> 35€/heure</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Cours en ligne</h3>
                    <p>Apprenez où que vous soyez avec nos cours en ligne flexibles.</p>
                    <p><strong>À partir de :</strong> 25€/heure</p>
                </div>
            </div>
            
            <h2>Notre approche pédagogique</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Méthode communicative</strong> - Focus sur la pratique orale et les situations réelles</li>
                <li style="margin-bottom: 10px;"><strong>Professeurs natifs</strong> - Enseignement par des locuteurs natifs expérimentés</li>
                <li style="margin-bottom: 10px;"><strong>Groupes réduits</strong> - Maximum 8 étudiants par classe pour une attention personnalisée</li>
                <li style="margin-bottom: 10px;"><strong>Contenu professionnel</strong> - Vocabulaire spécifique à votre domaine de stage</li>
                <li style="margin-bottom: 10px;"><strong>Certification</strong> - Possibilité de passer des examens officiels (TOEFL, IELTS, DELE, etc.)</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Demander des informations
                </a>
            </div>
        @else
            <p>Improve your language skills with our language courses tailored to your level and goals. We offer courses in several languages to help you integrate and succeed in your international internship environment.</p>
            
            <h2>Available Languages</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">English</h3>
                    <p>All levels available</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Spanish</h3>
                    <p>All levels available</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">German</h3>
                    <p>All levels available</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Italian</h3>
                    <p>All levels available</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">French</h3>
                    <p>All levels available</p>
                </div>
            </div>
            
            <h2>Course Formats</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Intensive Courses</h3>
                    <p>20 hours per week to progress quickly before or during your internship.</p>
                    <p><strong>Starting from:</strong> €200/week</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Regular Courses</h3>
                    <p>4-6 hours per week, compatible with your internship schedule.</p>
                    <p><strong>Starting from:</strong> €80/week</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Private Lessons</h3>
                    <p>Individual lessons tailored to your specific needs and pace.</p>
                    <p><strong>Starting from:</strong> €35/hour</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Online Courses</h3>
                    <p>Learn from anywhere with our flexible online courses.</p>
                    <p><strong>Starting from:</strong> €25/hour</p>
                </div>
            </div>
            
            <h2>Our Teaching Approach</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Communicative Method</strong> - Focus on oral practice and real-life situations</li>
                <li style="margin-bottom: 10px;"><strong>Native Teachers</strong> - Teaching by experienced native speakers</li>
                <li style="margin-bottom: 10px;"><strong>Small Groups</strong> - Maximum 8 students per class for personalized attention</li>
                <li style="margin-bottom: 10px;"><strong>Professional Content</strong> - Vocabulary specific to your internship field</li>
                <li style="margin-bottom: 10px;"><strong>Certification</strong> - Possibility to take official exams (TOEFL, IELTS, DELE, etc.)</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Request Information
                </a>
            </div>
        @endif
    </div>
@endsection