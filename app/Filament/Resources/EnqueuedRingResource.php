<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnqueuedRingResource\Pages;
use App\Filament\Resources\EnqueuedRingResource\RelationManagers;
use App\Models\EnqueuedRing;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnqueuedRingResource extends Resource
{
    protected static ?string $model = EnqueuedRing::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TimePicker::make('ring_at')
                    ->required()
                    ->native(false)
                    ->format('H:i')
                    ->seconds(false),
                Forms\Components\Select::make('type')->options([
                    'default' => 'Default',
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ring_at')
                    ->formatStateUsing(fn (Carbon $state) => $state->format('H:i'))
                    ->sortable()
            ])->defaultSort('ring_at')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEnqueuedRings::route('/'),
            'create' => Pages\CreateEnqueuedRing::route('/create'),
            'edit' => Pages\EditEnqueuedRing::route('/{record}/edit'),
        ];
    }
}
