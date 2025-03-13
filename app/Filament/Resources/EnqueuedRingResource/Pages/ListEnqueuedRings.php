<?php

namespace App\Filament\Resources\EnqueuedRingResource\Pages;

use App\Filament\Resources\EnqueuedRingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnqueuedRings extends ListRecords
{
    protected static string $resource = EnqueuedRingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
