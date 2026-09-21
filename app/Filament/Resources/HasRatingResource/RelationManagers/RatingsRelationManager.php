<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\HasRatingResource\RelationManagers;

<<<<<<< HEAD
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
=======
use Filament\Actions\BulkActionGroup;
>>>>>>> b2d53b8 (.)
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class RatingsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'ratings';

    /**
     * @return array<string, Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id'),
            'title' => TextColumn::make('title'),
            'pivot.user.name' => TextColumn::make('pivot.user.name'),
            'value' => TextColumn::make('value'),
            'is_winner' => TextColumn::make('is_winner'),
            'reward' => TextColumn::make('reward'),
            'updated_at' => TextColumn::make('updated_at'),
        ];
    }

    /**
     * @return array<string, Action>
     */
    public function getTableHeaderActions(): array
    {
        return [
            'create' => CreateAction::make(),
        ];
    }

    /**
     * @return array<string, Action>
     */
    public function getTableActions(): array
    {
        return [
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
     * @return array<string, BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
=======
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RatingsRelationManager extends RelationManager
{
    protected static string $relationship = 'ratings';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title'),
                TextColumn::make('pivot.user.name'),
                /*
                Tables\Columns\TextColumn::make('user.name')->default(function($record){
                    if($record->pivot->user_id==null){
                        return null;
                    }
                    return $record->pivot->user->name;
                }),
                */
                TextColumn::make('value'),
                TextColumn::make('is_winner'),
                TextColumn::make('reward'),
                TextColumn::make('updated_at'),
            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
>>>>>>> b2d53b8 (.)
    }
}
