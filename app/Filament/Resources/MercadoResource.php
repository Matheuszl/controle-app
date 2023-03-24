<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Mercado;
use App\Models\Produto;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

//ADCIONAIS DO FORMULARIO
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\MercadoResource\Pages;


class MercadoResource extends Resource
{
    protected static ?string $model = Mercado::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome'),
                TextInput::make('descricao'),

                Select::make('produtos')
                ->multiple()
                ->relationship('produtos', 'nome')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->label('Nome')->searchable(),
                TextColumn::make('produtos_count')->counts('produtos')->label('Qnt produtos')->sortable(),
                TextColumn::make('produtos_sum_preco')->sum('produtos', 'preco')->label('Preço Estimado')->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMercados::route('/'),
            'create' => Pages\CreateMercado::route('/create'),
            'edit' => Pages\EditMercado::route('/{record}/edit'),
        ];
    }
}