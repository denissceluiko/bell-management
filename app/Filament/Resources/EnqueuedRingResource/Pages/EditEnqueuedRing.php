<?php

namespace App\Filament\Resources\EnqueuedRingResource\Pages;

use App\Filament\Resources\EnqueuedRingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnqueuedRing extends EditRecord
{
    protected static string $resource = EnqueuedRingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
