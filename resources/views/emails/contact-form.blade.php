<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #667eea;">📧 Nouveau Message de Contact</h2>
        
        <p><strong>Nom :</strong> {{ $contactData['name'] }}</p>
        <p><strong>Email :</strong> {{ $contactData['email'] }}</p>
        <p><strong>Téléphone :</strong> {{ $contactData['phone'] ?? 'Non renseigné' }}</p>
        <p><strong>Sujet :</strong> {{ $contactData['subject'] ?? 'Autre' }}</p>
        <p><strong>Date :</strong> {{ $contactData['submitted_at']->format('d/m/Y à H:i') }}</p>
        
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3>Message :</h3>
            <p>{{ $contactData['message'] }}</p>
        </div>
        
        <p style="font-size: 0.9em; color: #666;">
            IP : {{ $contactData['ip_address'] ?? 'N/A' }}
        </p>
    </div>
</body>
</html>