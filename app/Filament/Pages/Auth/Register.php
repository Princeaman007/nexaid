<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getRegisterFormAction(),
            $this->getLoginLink(),
        ];
    }

    protected function getLoginLink(): Action
    {
        return Action::make('login')
            ->link()
            ->label('Already have an account? Log in')
            ->url(route('filament.admin.auth.login'));
    }
}