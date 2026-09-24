<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\HasRatingResource\RelationManagers;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
=======
use Filament\Actions\BulkActionGroup;
>>>>>>> e8cf105 (Check & fix styling)
=======
use Filament\Actions\BulkActionGroup;
>>>>>>> 77b9106 (.)
=======
use Filament\Actions\BulkActionGroup;
>>>>>>> c91c8c3 (.)
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

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
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    }
}
