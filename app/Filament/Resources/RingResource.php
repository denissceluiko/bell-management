<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RingResource\Pages;
use App\Filament\Resources\RingResource\RelationManagers;
use App\Models\Ring;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RingResource extends Resource
{
    protected static ?string $model = Ring::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TimePicker::make('ring_at')
                    ->required()
                    ->native(false)
                    ->format('H:i')
                    ->seconds(false),
                Forms\Components\TextInput::make('name'),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
            ])->defaultSort('ring_at')
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListRings::route('/'),
            'create' => Pages\CreateRing::route('/create'),
            'edit' => Pages\EditRing::route('/{record}/edit'),
        ];
    }
}
