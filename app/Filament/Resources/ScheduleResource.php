<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $pluralLabel = 'Schedule';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('type')->options([
                    'holiday' => 'Holiday',
                    'workday' => 'Workday',
                    'annual_holiday' => 'Annual holiday',
                ])->required(),
                Forms\Components\DatePicker::make('start_at')
                    ->native(false)
                    ->displayFormat('d.m.Y')
                    ->live()
                    ->afterStateUpdated(function (?string $state, Set $set, Get $get) {
                        if (empty($get('end_at'))) {
                            $set('end_at', $state);
                        }
                    })
                    ->required(),
                Forms\Components\DatePicker::make('end_at')
                    ->native(false)
                    ->displayFormat('d.m.Y')
                    ->minDate(fn (Get $get) => $get('start_at'))
                    ->required(),
                Forms\Components\Toggle::make('enabled')
                    ->default(true),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
