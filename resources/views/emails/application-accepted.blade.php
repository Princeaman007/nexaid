<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidature acceptée</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .success-icon { font-size: 48px; margin-bottom: 20px; }
        .btn { display: inline-block; background: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1>Félicitations !</h1>
            <p>Votre candidature a été acceptée</p>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $application->name }}</strong>,</p>
            
            <p>Nous avons le plaisir de vous informer que votre candidature pour le poste de <strong>{{ $application->internship->title }}</strong> chez <strong>{{ $application->internship->company_name }}</strong> a été retenue.</p>
            
            @if($customMessage)
                <div style="background: white; padding: 20px; border-left: 4px solid #28a745; margin: 20px 0;">
                    <p><strong>Message personnalisé :</strong></p>
                    <p>{{ $customMessage }}</p>
                </div>
            @endif
            
            <p><strong>Détails du stage :</strong></p>
            <ul>
                <li><strong>Poste :</strong> {{ $application->internship->title }}</li>
                <li><strong>Entreprise :</strong> {{ $application->internship->company_name }}</li>
                <li><strong>Lieu :</strong> {{ $application->internship->location }}</li>
                @if($application->internship->duration)
                    <li><strong>Durée :</strong> {{ $application->internship->duration }}</li>
                @endif
            </ul>
            
            <p>Nous vous contacterons prochainement pour finaliser les détails de votre intégration.</p>
            
            <p>Cordialement,<br>
            L'équipe {{ config('app.name') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ config('app.name') }} - {{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>