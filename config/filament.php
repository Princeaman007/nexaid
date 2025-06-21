<?php

// Créez un fichier config/filament.php ou modifiez-le
return [
    'brand' => null, // Supprime le texte "Filament"
    'favicon' => null, // Changez le favicon par celui de votre client
    'brand_logo' => null, // Ajoutez le logo de votre client
    'navigation' => [
        'sidebar' => [
            'footer' => null, // Supprime le footer par défaut
            'groups' => [
            'Gestion' => [
                'collapsible' => true,
                'collapsed' => false,
            ],
            'Stages' => [
                'collapsible' => true,
                'collapsed' => false,
            ],
            'Public' => [
                'collapsible' => true,
                'collapsed' => true,
            ],
            'Statistiques' => [
                'collapsible' => true,
                'collapsed' => true,
            ],
        ],
        ],
    ],
];