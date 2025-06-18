<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidature</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .footer { text-align: center; margin-top: 30px; font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p>Réponse à votre candidature</p>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $application->name }}</strong>,</p>
            
            <p>Nous vous remercions pour l'intérêt que vous avez porté au poste de <strong>{{ $application->internship->title }}</strong> chez <strong>{{ $application->internship->company_name }}</strong>.</p>
            
            <p>Après étude attentive de votre dossier, nous regrettons de vous informer que nous ne pouvons pas donner suite favorable à votre candidature pour cette offre.</p>
            
            @if($customMessage)
                <div style="background: white; padding: 20px; border-left: 4px solid #667eea; margin: 20px 0;">
                    <p>{{ $customMessage }}</p>
                </div>
            @endif
            
            <p>Cette décision ne remet nullement en cause vos compétences. Nous vous encourageons à postuler à nos futures offres qui pourraient mieux correspondre à votre profil.</p>
            
            <p>Nous vous souhaitons plein succès dans vos recherches.</p>
            
            <p>Cordialement,<br>
            L'équipe {{ config('app.name') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ config('app.name') }} - {{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>