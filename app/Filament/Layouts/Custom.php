<?php

// app/Filament/Layouts/Custom.php
namespace App\Filament\Layouts;

use Filament\Layouts\BasePage;

class Custom extends BasePage
{
    protected function getFooter(): ?View
    {
        return null; // Supprime complètement le footer
    }
    
    protected function getBrandLogo(): ?View
    {
        return view('filament.components.brand-logo');
    }
}