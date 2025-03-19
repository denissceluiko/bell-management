<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
