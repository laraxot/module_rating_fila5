<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Filament\Schemas\Components\Component as SchemaComponent;
use Filament\Tables\Columns\Column;
use Modules\Rating\Filament\Resources\RatingMorphResource\Schemas\RatingMorphForm;
use Modules\Rating\Filament\Resources\RatingMorphResource\Schemas\RatingMorphInfolist;
use Modules\Rating\Filament\Resources\RatingMorphResource\Tables\RatingMorphsTable;
use Modules\Rating\Filament\Resources\RatingMorphResource\Tables\RatingMorphTable;
use Modules\Rating\Filament\Resources\RatingResource\Schemas\RatingForm;
use Modules\Rating\Filament\Resources\RatingResource\Schemas\RatingInfolist;
use Modules\Rating\Filament\Resources\RatingResource\Tables\RatingsTable;
use Modules\Rating\Filament\Resources\RatingResource\Tables\RatingTable;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

/**
 * Convenzione XotBase: gli schema sono array **associativi** — la chiave è il nome del
 * campo e sostituisce la label esplicita. Un array a chiavi numeriche è una regressione,
 * non uno stile diverso.
 *
 * @param  array<array-key, mixed>  $schema
 */
function ratingAssertKeyedSchema(array $schema, string $tipo): void
{
    Assert::assertNotEmpty($schema);

    foreach (array_keys($schema) as $chiave) {
        Assert::assertIsString($chiave, "chiave numerica in {$tipo}");
        Assert::assertNotSame('', $chiave);
    }
}

test('le tabelle espongono colonne indicizzate per campo', function (string $classe): void {
    $colonne = app($classe)->getTableColumns();

    ratingAssertKeyedSchema($colonne, $classe);
    Assert::assertContainsOnlyInstancesOf(Column::class, $colonne);
})->with([
    RatingsTable::class,
    RatingTable::class,
    RatingMorphsTable::class,
    RatingMorphTable::class,
]);

test('le tabelle dichiarano filtri e azioni senza esplodere', function (string $classe): void {
    $tabella = app($classe);

    Assert::assertIsArray($tabella->getTableFilters());
    Assert::assertIsArray($tabella->getTableActions());
    Assert::assertIsArray($tabella->getTableBulkActions());
})->with([
    RatingsTable::class,
    RatingTable::class,
    RatingMorphsTable::class,
    RatingMorphTable::class,
]);

test('RatingsTable copre i campi anagrafici del rating', function (): void {
    Assert::assertSame(
        ['id', 'title', 'slug', 'rule', 'is_disabled', 'is_readonly', 'order_column', 'created_at', 'updated_at'],
        array_keys(app(RatingsTable::class)->getTableColumns()),
    );
});

test('i form espongono uno schema indicizzato per campo', function (string $classe): void {
    $schema = $classe::getFormSchema();

    ratingAssertKeyedSchema($schema, $classe);
    Assert::assertContainsOnlyInstancesOf(SchemaComponent::class, $schema);
})->with([
    RatingForm::class,
]);

test('RatingMorphForm è ancora uno stub vuoto', function (): void {
    // Contratto reale, non desiderato: `getFormSchema()` ritorna `[]` e il create/edit di
    // RatingMorphResource non renderizza alcun campo, mentre l'infolist della stessa
    // resource ne dichiara otto. È una lacuna aperta, segnalata in
    // docs/testing-and-coverage.md: quando verrà colmata, questo test va aggiornato
    // spostando la classe nel dataset qui sopra.
    Assert::assertSame([], RatingMorphForm::getFormSchema());
});

test('gli infolist espongono uno schema indicizzato per campo', function (string $classe): void {
    ratingAssertKeyedSchema($classe::getInfolistSchema(), $classe);
})->with([
    RatingInfolist::class,
    RatingMorphInfolist::class,
]);

test('il form del rating dichiara i campi attesi', function (): void {
    Assert::assertSame(
        ['title', 'color', 'rule', 'flags', 'txt'],
        array_keys(RatingForm::getFormSchema()),
    );
});

test('i form usano una sola colonna e nessuno step wizard', function (string $classe): void {
    Assert::assertSame(1, $classe::getFormSchemaColumns());
    Assert::assertSame([], $classe::getSteps());
})->with([
    RatingForm::class,
    RatingMorphForm::class,
]);
