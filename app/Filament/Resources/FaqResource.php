<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;




class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Tabs::make('Traductions')
            ->tabs([
                Tabs\Tab::make('Français')->schema([
                    Textarea::make('question.fr')->required()->label('Question (français)'),
                    Textarea::make('answer.fr')->required()->label('Réponse (français)'),
                ]),
                Tabs\Tab::make('English')->schema([
                    Textarea::make('question.en')->required()->label('Question (English)'),
                    Textarea::make('answer.en')->required()->label('Answer (English)'),
                ]),
            ]),
        Toggle::make('is_active')->default(true),
    ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('question.' . app()->getLocale())
                ->label('Question')
                ->limit(50),
            BooleanColumn::make('is_active')
                ->label('Actif'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
