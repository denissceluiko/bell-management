<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchedule extends EditRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['type'] == 'annual_holiday') {
            $data['start_at'] = $this->dropYear($data['start_at']);
            $data['end_at'] = $this->dropYear($data['end_at']);
        }

        return $data;
    }

    protected function dropYear(string $date): string
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $date->setYear(1970);
        return $date->format('Y-m-d');
    }
}
