<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Schedule;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('New Entry')),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('start_at')
                    ->date('d.m.Y'),
                Tables\Columns\TextColumn::make('end_at')
                    ->date('d.m.Y'),
                Tables\Columns\TextColumn::make('type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hiddenLabel(true),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()->badge(Schedule::query()->count()),
            'holidays' => Tab::make()
                ->badge(Schedule::query()->type('holiday')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->type('holiday')),
            'workdays' => Tab::make()
                ->badge(Schedule::query()->workday()->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->workday()),
            'annual_holidays' => Tab::make()
                ->badge(Schedule::query()->type('annual_holiday')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->type('annual_holiday')),
        ];
    }
}
