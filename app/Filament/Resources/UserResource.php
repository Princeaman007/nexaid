<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Administration';
    
    protected static ?string $navigationLabel = 'Administrateurs';
    
    protected static ?string $slug = 'administrateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nom'),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->label('Mot de passe')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
                    
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'superAdmin' => 'Super Admin', // Corrigé pour correspondre à la DB
                    ])
                    ->required()
                    ->default('admin')
                    ->label('Rôle'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->label('Nom')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')
                    ->label('Rôle')
                    ->badge()
                    ->colors([
                        'warning' => 'admin',
                        'success' => 'superAdmin', // Corrigé pour correspondre à la DB
                    ]),
                TextColumn::make('created_at')->label('Créé le')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    
    // Restreindre l'accès uniquement aux super admins
    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'superAdmin'; // Corrigé pour correspondre à la DB
    }
    
    public static function canCreate(): bool
    {
        return auth()->user()->role === 'superAdmin'; // Corrigé pour correspondre à la DB
    }
    
    public static function canEdit(Model $record): bool
    {
        return auth()->user()->role === 'superAdmin'; // Corrigé pour correspondre à la DB
    }
    
    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role === 'superAdmin'; // Corrigé pour correspondre à la DB
    }
}