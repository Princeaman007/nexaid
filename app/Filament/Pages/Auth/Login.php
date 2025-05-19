<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
            // Supprimé le lien d'inscription
            // $this->getRegisterFormAction(),
            $this->getForgotPasswordAction(),
        ];
    }

    // Méthode supprimée car l'inscription n'est plus disponible
    // protected function getRegisterFormAction(): Action
    // {
    //     return Action::make('register')
    //         ->link()
    //         ->label('Create an account')
    //         ->url(route('filament.admin.auth.register'));
    // }

    protected function getForgotPasswordAction(): Action
    {
        return Action::make('forgot-password')
            ->link()
            ->label('Forgot password?')
            ->url(route('filament.admin.auth.password-reset.request'));
    }
}