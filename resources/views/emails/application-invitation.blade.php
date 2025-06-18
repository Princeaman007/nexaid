<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Convocation entretien</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .interview-details { background: white; padding: 20px; border-left: 4px solid #17a2b8; margin: 20px 0; border-radius: 5px; }
        .footer { text-align: center; margin-top: 30px; font-size: 0.9rem; color: #666; }
        .calendar-icon { font-size: 48px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="calendar-icon">📅</div>
            <h1>Convocation à un entretien</h1>
            <p>{{ $application->internship->title }}</p>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $application->name }}</strong>,</p>
            
            <p>Suite à votre candidature pour le poste de <strong>{{ $application->internship->title }}</strong> chez <strong>{{ $application->internship->company_name }}</strong>, nous avons le plaisir de vous convoquer à un entretien.</p>
            
            @if($customMessage)
                <div style="background: white; padding: 20px; border-left: 4px solid #17a2b8; margin: 20px 0;">
                    <p>{{ $customMessage }}</p>
                </div>
            @endif
            
            <div class="interview-details">
                <h3 style="margin-top: 0; color: #17a2b8;">📋 Détails de l'entretien</h3>
                
                @if($application->interview_date)
                    <p><strong>📅 Date et heure :</strong><br>
                    {{ \Carbon\Carbon::parse($application->interview_date)->translatedFormat('l d F Y à H:i') }}</p>
                @endif
                
                @if($application->interview_location)
                    <p><strong>📍 Lieu :</strong><br>
                    {{ $application->interview_location }}</p>
                @endif
                
                <p><strong>💼 Poste :</strong> {{ $application->internship->title }}</p>
                <p><strong>🏢 Entreprise :</strong> {{ $application->internship->company_name }}</p>
            </div>
            
            <p><strong>📝 À prévoir :</strong></p>
            <ul>
                <li>Une pièce d'identité</li>
                <li>Votre CV à jour</li>
                <li>Vos diplômes et certificats</li>
                <li>Toute question que vous souhaitez poser</li>
            </ul>
            
            <p>Merci de confirmer votre présence en répondant à cet email.</p>
            
            <p>En cas d'empêchement, contactez-nous au plus vite pour reprogrammer.</p>
            
            <p>Nous nous réjouissons de vous rencontrer !</p>
            
            <p>Cordialement,<br>
            L'équipe {{ config('app.name') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ config('app.name') }} - {{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>