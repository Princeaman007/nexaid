<?php
namespace App\Filament\Widgets;

use App\Filament\Resources\PartnershipRequestResource;
use App\Models\PartnershipRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentPartnershipRequests extends BaseWidget
{
    protected static ?string $heading = 'Recent Partnership Requests';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PartnershipRequest::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Company')
                    ->searchable()
                    ->limit(20),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('partnership_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'strategic' => 'success',
                        'commercial' => 'warning',
                        'technological' => 'info',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (PartnershipRequest $record): string => $record->status_color),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (PartnershipRequest $record): string => PartnershipRequestResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated(false);
    }
}