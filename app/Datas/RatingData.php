<?php

declare(strict_types=1);

namespace Modules\Rating\Datas;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Rating\Enums\SupportedLocale;
use Modules\Rating\Models\BaseRating;
use Modules\Xot\Database\Migrations\XotBaseMigration;
use RuntimeException;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * DTO per un rating.
 *
 * ATTENZIONE — due concetti nello stesso nome (blocco UI + colonne migration).
 * Split `RatingBlockData` / entity tracciato a parte.
 *
 * `getXlsFields($where)` = catalogo export **solo rating**. Risolve
 * `Modules\<Mod>\Models\Rating` dal backtrace (anche static `Filament\Resources\*`)
 * perché IR Rating usa connection `indennita_responsabilita`.
 * Canon: `docs/bmad/architecture/ratingdata-getxlsfields-caller-resolve.md`.
 */
class RatingData extends Data
{
    public function __construct(
        public readonly string $title = '',
        public readonly string $description = '',
        public readonly bool $disabled = false,
        public readonly int $position = 0,
        public readonly SupportedLocale $locale = SupportedLocale::IT,
        public readonly ?string $image_url = null,
        public readonly ?int $parent_id = null,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return self::from($data);
    }

    /**
     * Percorso `data_get` del campo pivot di un rating sull'host
     * (es. `ratings_by_id.52.pivot.value`).
     */
    public static function ratingValuePath(BaseRating $rating, string $field = 'value'): string
    {
        return 'ratings_by_id.'.$rating->id.'.pivot.'.$field;
    }

    /**
     * Percorso `data_get` del valore leggibile in export XLS/XLSX
     * (`xls_export_value`: txt del figlio se Select, altrimenti pivot.value).
     *
     * @see BaseRating::getXlsExportValueAttribute()
     */
    public static function ratingXlsValuePath(BaseRating $rating): string
    {
        return 'ratings_by_id.'.$rating->id.'.xls_export_value';
    }

    /**
     * Testo etichetta form per un criterio: `txt` se presente, altrimenti `title`.
     *
     * Diverso da {@see BaseRating::getLabel()} (albero / solo `title`). Il metodo
     * non chiama `->label()` Filament: restituisce solo la stringa, l'host (o
     * {@see \Modules\Rating\Filament\Concerns\DecoratesRatingFormFields}) la applica.
     *
     * Sede: funzione pura di `$rating`, nessuna dipendenza dall'host — per questo
     * qui e non in `HasRatingsTrait` (trait per gli host, non per l'entità rating).
     * Canon: `docs/bmad/architecture/rating-entity-helpers-home-in-ratingdata.md`.
     */
    public static function formFieldLabel(BaseRating $rating): string
    {
        return strip_tags((string) ($rating->txt ?? $rating->title));
    }

    /**
     * Catalogo colonne XLS/XLSX **solo rating** (path => label).
     *
     * @param  array<string, mixed>  $where
     * @param  class-string<BaseRating>|null  $ratingClass
     * @return array<string, string>
     */
    public static function getXlsFields(array $where, ?string $ratingClass = null): array
    {
        $ratingClass ??= self::resolveRatingClassFromCaller();
        Assert::implementsInterface($ratingClass, RatingContract::class);

        /** @var EloquentCollection<int, BaseRating> $ratings */
        $ratings = $ratingClass::withExtraAttributes($where)->ordered()->get();
        $ratings = $ratings
            ->reject(static fn (BaseRating $rating): bool => $rating->parent_id !== null)
            ->values();
        $ratings->loadMissing('children');

        return self::criteriaToXlsFields($ratings);
    }

    /**
     * @param  iterable<int, BaseRating>  $ratings
     * @return array<string, string>
     */
    public static function criteriaToXlsFields(iterable $ratings): array
    {
        if ($ratings instanceof EloquentCollection) {
            $ratings->loadMissing('children');
        }

        $fields = [];

        foreach ($ratings as $rating) {
            if ($rating->parent_id !== null) {
                continue;
            }

            $label = self::formFieldLabel($rating);
            if ($label === '') {
                $label = 'Rating '.$rating->id;
            }

            $fields[self::ratingXlsValuePath($rating)] = $label;

            $children = $rating->relationLoaded('children')
                ? $rating->children
                : Collection::make();

            if ($children->isNotEmpty()) {
                $fields[self::ratingValuePath($rating, 'note')] = (string) __(
                    'rating::fields.note_for',
                    ['label' => $label],
                );
            }
        }

        return $fields;
    }

    /**
     * Come getClassName(), ma accetta frame statici Filament\Resources / Models.
     *
     * @return class-string<BaseRating>
     */
    public static function resolveRatingClassFromCaller(): string
    {
        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 40) as $frame) {
            $class = null;

            if (isset($frame['object']) && is_object($frame['object'])) {
                $class = $frame['object']::class;
                if (method_exists($frame['object'], 'getModelClass')) {
                    /** @var mixed $modelClass */
                    $modelClass = $frame['object']->getModelClass();
                    if (is_string($modelClass) && $modelClass !== '') {
                        $class = $modelClass;
                    }
                }
            } elseif (isset($frame['class']) && is_string($frame['class'])) {
                $class = $frame['class'];
            }

            if (! is_string($class) || ! str_contains($class, 'Modules\\')) {
                continue;
            }

            if (str_contains($class, '\\Datas\\RatingData')
                || str_contains($class, '\\Traits\\HasRatingsTrait')
                || str_ends_with($class, '\\Models\\BaseRating')) {
                continue;
            }

            $namespace = null;
            if (str_contains($class, '\\Models\\')) {
                $namespace = Str::beforeLast($class, '\\Models\\');
            } elseif (str_contains($class, '\\Filament\\')) {
                $namespace = Str::before($class, '\\Filament\\');
            }

            if (! is_string($namespace) || $namespace === '') {
                continue;
            }

            $candidate = $namespace.'\\Models\\Rating';
            if (class_exists($candidate) && is_subclass_of($candidate, RatingContract::class)) {
                /** @var class-string<BaseRating> $candidate */
                return $candidate;
            }
        }

        throw new RuntimeException(
            'Unable to resolve Modules\\*\\Models\\Rating from caller backtrace. '
            .'Pass $ratingClass explicitly to RatingData::getXlsFields($where, $ratingClass).',
        );
    }

    public static function updateColumns(Blueprint $table, ?XotBaseMigration $migration = null): void
    {
        $missing = static fn (string $column): bool => ! $migration instanceof XotBaseMigration
            || ! $migration->hasColumn($column);

        if ($missing('title')) {
            $table->string('title')->nullable();
        }
        if ($missing('slug')) {
            $table->string('slug')->nullable()->index();
        }
        if ($missing('color')) {
            $table->string('color')->nullable();
        }
        if ($missing('icon')) {
            $table->string('icon')->nullable();
        }
        if ($missing('rule')) {
            $table->string('rule')->nullable();
        }
        if ($missing('txt')) {
            $table->text('txt')->nullable();
        }
        if ($missing('extra_attributes')) {
            $table->schemalessAttributes('extra_attributes');
        }
        if ($missing('is_disabled')) {
            $table->boolean('is_disabled')->nullable();
        }
        if ($missing('is_readonly')) {
            $table->boolean('is_readonly')->nullable();
        }
        if ($missing('order_column')) {
            $table->unsignedInteger('order_column')->nullable()->index();
        }
        if ($missing('parent_id')) {
            $table->unsignedBigInteger('parent_id')->nullable();
        }
    }
}
