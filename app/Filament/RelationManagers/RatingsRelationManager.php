<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\RelationManagers;

<<<<<<< HEAD
use Filament\Actions\BulkActionGroup;
=======
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
>>>>>>> laraxot/dev
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
<<<<<<< HEAD
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
=======
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
>>>>>>> laraxot/dev

class RatingsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'ratings';

<<<<<<< HEAD
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title'),
                TextColumn::make('pivot.user.name'),
                TextColumn::make('value'),
                TextColumn::make('is_winner'),
                TextColumn::make('reward'),
                TextColumn::make('updated_at'),
            ])
            ->filters([])
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
=======
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
>>>>>>> laraxot/dev
    }
}
