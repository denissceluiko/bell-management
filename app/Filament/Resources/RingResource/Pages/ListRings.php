<?php

namespace App\Filament\Resources\RingResource\Pages;

use App\Filament\Resources\RingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRings extends ListRecords
{
    protected static string $resource = RingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
