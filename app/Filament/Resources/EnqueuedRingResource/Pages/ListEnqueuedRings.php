<?php

namespace App\Filament\Resources\EnqueuedRingResource\Pages;

use App\Filament\Resources\EnqueuedRingResource;
use App\Jobs\EnqueueRings;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;

class ListEnqueuedRings extends ListRecords
{
    protected static string $resource = EnqueuedRingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Regenerate')
                ->action(function() {
                    EnqueueRings::dispatch();
                })->color(Color::Purple),
            Actions\CreateAction::make(),
        ];
    }
}
