<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipRequestResource\Pages;
use App\Models\PartnershipRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class PartnershipRequestResource extends Resource
{
    protected static ?string $model = PartnershipRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Partnership Requests';

    protected static ?string $modelLabel = 'Partnership Request';

    protected static ?string $pluralModelLabel = 'Partnership Requests';

    protected static ?string $navigationGroup = 'Business Development';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Company Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Company Name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Contact Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('address')
                            ->label('Address')
                            ->rows(3),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Company Description')
                            ->rows(4),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Partnership Details')
                    ->schema([
                        Forms\Components\CheckboxList::make('services_needed')
                            ->label('Services Needed')
                            ->options(PartnershipRequest::AVAILABLE_SERVICES)
                            ->columns(2),
                        
                        Forms\Components\Select::make('partnership_type')
                            ->label('Partnership Type')
                            ->options(PartnershipRequest::PARTNERSHIP_TYPES)
                            ->placeholder('Select partnership type'),
                        
                        Forms\Components\Select::make('partnership_duration')
                            ->label('Partnership Duration')
                            ->options(PartnershipRequest::PARTNERSHIP_DURATIONS)
                            ->placeholder('Select duration'),
                        
                        Forms\Components\TextInput::make('budget_range')
                            ->label('Budget Range (€)')
                            ->numeric()
                            ->prefix('€')
                            ->placeholder('25000'),
                        
                        Forms\Components\Toggle::make('long_term_partnership')
                            ->label('Interested in Long-term Partnership'),
                        
                        Forms\Components\Textarea::make('collaboration_expectations')
                            ->label('Collaboration Expectations')
                            ->rows(4),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Review & Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(PartnershipRequest::STATUSES)
                            ->required()
                            ->default('pending'),
                        
                        Forms\Components\Select::make('reviewed_by')
                            ->label('Reviewed By')
                            ->options(User::all()->pluck('name', 'id'))
                            ->placeholder('Select reviewer'),
                        
                        Forms\Components\DateTimePicker::make('reviewed_at')
                            ->label('Reviewed At'),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3)
                            ->placeholder('Internal notes about this request...'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::SemiBold),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                
                Tables\Columns\TextColumn::make('partnership_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'strategic' => 'success',
                        'commercial' => 'warning',
                        'technological' => 'info',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('formatted_budget')
                    ->label('Budget')
                    ->sortable('budget_range'),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (PartnershipRequest $record): string => $record->status_color),
                
                Tables\Columns\IconColumn::make('long_term_partnership')
                    ->label('Long-term')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                
                Tables\Columns\TextColumn::make('reviewedBy.name')
                    ->label('Reviewed By')
                    ->placeholder('Not reviewed'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(PartnershipRequest::STATUSES),
                
                SelectFilter::make('partnership_type')
                    ->label('Partnership Type')
                    ->options(PartnershipRequest::PARTNERSHIP_TYPES),
                
                Filter::make('long_term')
                    ->label('Long-term Partnership')
                    ->query(fn (Builder $query): Builder => $query->where('long_term_partnership', true)),
                
                Filter::make('recent')
                    ->label('Recent (Last 30 days)')
                    ->query(fn (Builder $query): Builder => $query->recent()),
                
                Filter::make('has_budget')
                    ->label('Has Budget Info')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('budget_range')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (PartnershipRequest $record): bool => $record->status !== 'approved')
                    ->action(function (PartnershipRequest $record): void {
                        $record->update([
                            'status' => 'approved',
                            'reviewed_at' => now(),
                            'reviewed_by' => auth()->id(),
                        ]);
                        
                        Notification::make()
                            ->title('Partnership request approved')
                            ->success()
                            ->send();
                    }),
                
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (PartnershipRequest $record): bool => $record->status !== 'rejected')
                    ->action(function (PartnershipRequest $record): void {
                        $record->update([
                            'status' => 'rejected',
                            'reviewed_at' => now(),
                            'reviewed_by' => auth()->id(),
                        ]);
                        
                        Notification::make()
                            ->title('Partnership request rejected')
                            ->danger()
                            ->send();
                    }),
                
                Action::make('contact')
                    ->label('Mark as Contacted')
                    ->icon('heroicon-o-phone')
                    ->color('info')
                    ->visible(fn (PartnershipRequest $record): bool => $record->status !== 'contacted')
                    ->action(function (PartnershipRequest $record): void {
                        $record->update([
                            'status' => 'contacted',
                            'reviewed_at' => now(),
                            'reviewed_by' => auth()->id(),
                        ]);
                        
                        Notification::make()
                            ->title('Partnership request marked as contacted')
                            ->info()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('mark_in_review')
                        ->label('Mark as In Review')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->action(function ($records): void {
                            $records->each(function (PartnershipRequest $record) {
                                $record->update([
                                    'status' => 'in_review',
                                    'reviewed_at' => now(),
                                    'reviewed_by' => auth()->id(),
                                ]);
                            });
                            
                            Notification::make()
                                ->title('Selected requests marked as in review')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Company Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Company Name')
                            ->weight(FontWeight::Bold),
                        
                        Infolists\Components\TextEntry::make('email')
                            ->label('Contact Email')
                            ->copyable()
                            ->icon('heroicon-m-envelope'),
                        
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Phone Number')
                            ->icon('heroicon-m-phone')
                            ->placeholder('Not provided'),
                        
                        Infolists\Components\TextEntry::make('website')
                            ->label('Website')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->placeholder('Not provided'),
                        
                        Infolists\Components\TextEntry::make('address')
                            ->label('Address')
                            ->placeholder('Not provided'),
                        
                        Infolists\Components\TextEntry::make('description')
                            ->label('Company Description')
                            ->placeholder('Not provided'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Partnership Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('services_string')
                            ->label('Services Needed'),
                        
                        Infolists\Components\TextEntry::make('partnership_type')
                            ->label('Partnership Type')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'strategic' => 'success',
                                'commercial' => 'warning',
                                'technological' => 'info',
                                default => 'gray',
                            }),
                        
                        Infolists\Components\TextEntry::make('partnership_duration')
                            ->label('Duration'),
                        
                        Infolists\Components\TextEntry::make('formatted_budget')
                            ->label('Budget Range'),
                        
                        Infolists\Components\IconEntry::make('long_term_partnership')
                            ->label('Long-term Partnership Interest')
                            ->boolean(),
                        
                        Infolists\Components\TextEntry::make('collaboration_expectations')
                            ->label('Collaboration Expectations')
                            ->placeholder('Not provided'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Review Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (PartnershipRequest $record): string => $record->status_color),
                        
                        Infolists\Components\TextEntry::make('reviewedBy.name')
                            ->label('Reviewed By')
                            ->placeholder('Not reviewed'),
                        
                        Infolists\Components\TextEntry::make('reviewed_at')
                            ->label('Reviewed At')
                            ->dateTime()
                            ->placeholder('Not reviewed'),
                        
                        Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->placeholder('No notes'),
                        
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Submitted At')
                            ->dateTime(),
                    ])
                    ->columns(2),
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
            'index' => Pages\ListPartnershipRequests::route('/'),
            'create' => Pages\CreatePartnershipRequest::route('/create'),
            'view' => Pages\ViewPartnershipRequest::route('/{record}'),
            'edit' => Pages\EditPartnershipRequest::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::pending()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $pendingCount = static::getModel()::pending()->count();
        
        if ($pendingCount > 10) {
            return 'danger';
        }
        
        if ($pendingCount > 5) {
            return 'warning';
        }
        
        return 'primary';
    }
}