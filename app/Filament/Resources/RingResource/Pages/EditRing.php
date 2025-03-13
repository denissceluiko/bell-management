<?php

namespace App\Filament\Resources\RingResource\Pages;

use App\Filament\Resources\RingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRing extends EditRecord
{
    protected static string $resource = RingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
