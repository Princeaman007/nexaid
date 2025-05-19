<?php

namespace App\Filament\Layouts;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function render()
    {
        return view('filament.layouts.admin');
    }
}