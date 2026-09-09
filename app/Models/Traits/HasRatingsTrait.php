<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
<<<<<<< .merge_file_85B2Nz
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
=======
>>>>>>> .merge_file_Obnfis
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Rating\Contracts\RatingsFormCallerContract;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Webmozart\Assert\Assert;

/**
 * Trait HasRatingsTrait — rating polimorfi su modelli host.
 *
 * Perché: un solo punto per relazioni, sync per extra_attributes, regole validazione.
 * Consumer: `@use HasRatingsTrait<static>` sulla classe host.
 *
 * @template TModel of Model
 *
 * @phpstan-require-extends Model
 */
trait HasRatingsTrait
{
    /**
<<<<<<< .merge_file_85B2Nz
     * Le righe pivot della valutazione, **entrambe le forme di `model_type`**.
     *
     * `rating_morph.model_type` contiene per la stessa entità sia l'alias della morph
     * map sia il FQCN del model, a seconda di come è stata scritta la riga. Misurato
     * su un'installazione: 180 righe con l'alias (2 record) e 2.045 con il FQCN
     * (228 record). `ratings()` è una `morphToMany` e vede **solo** `getMorphClass()`,
     * cioè l'alias: chi ci aggrega sopra conta 2 record su 230 e mostra un numero
     * sbagliato che sembra giusto.
     *
     * Questa relazione esiste per leggere lo stato reale finché i dati non sono
     * normalizzati. **È una misura di transizione, non il modello giusto**: la cura è
     * un `UPDATE` che porta `model_type` all'alias ovunque, e va decisa da chi possiede
     * i dati. Vedi la story `rating-morph-model-type-doppio`.
     *
     * Aggrega qui e non su `ratings()` anche per un secondo motivo: `value` sta sul
     * pivot, non su `ratings`, quindi `sum('ratings', 'value')` è un errore SQL
     * (`Unknown column 'ratings.value'`).
     *
     * @return HasMany<MorphPivot, TModel>
     */
    public function ratingMorphs(): HasMany
    {
        $pivot = $this->guessMorphPivot(Rating::getClassName());

        /** @var HasMany<MorphPivot, TModel> $relation */
        $relation = $this->hasMany($pivot::class, 'model_id', $this->getKeyName())
            ->whereIn('model_type', array_unique([$this->getMorphClass(), static::class]));

        return $relation;
    }

    /**
=======
     * Resolve the Rating class for the host model's module.
     *
     * @return class-string<BaseRating>
     */
    protected function resolveRatingClass(): string
    {
        // Try to resolve Rating class based on host model's namespace
        $hostClass = static::class;
        $namespace = Str::beforeLast($hostClass, '\\Models\\');

        // Check if module-specific Rating exists
        $moduleRatingClass = $namespace.'\\Models\\Rating';
        if (class_exists($moduleRatingClass) && is_subclass_of($moduleRatingClass, BaseRating::class)) {
            return $moduleRatingClass;
        }

        // Fallback to base Rating module
        return Rating::class;
    }

    /**
     * Le righe pivot della valutazione, **entrambe le forme di `model_type`**.
     *
     * `rating_morph.model_type` contiene per la stessa entità sia l'alias della morph
     * map sia il FQCN del model, a seconda di come è stata scritta la riga. Misurato
     * su un'installazione: 180 righe con l'alias (2 record) e 2.045 con il FQCN
     * (228 record). `ratings()` è una `morphToMany` e vede **solo** `getMorphClass()`,
     * cioè l'alias: chi ci aggrega sopra conta 2 record su 230 e mostra un numero
     * sbagliato che sembra giusto.
     *
     * Questa relazione esiste per leggere lo stato reale finché i dati non sono
     * normalizzati. **È una misura di transizione, non il modello giusto**: la cura è
     * un `UPDATE` che porta `model_type` all'alias ovunque, e va decisa da chi possiede
     * i dati. Vedi la story `rating-morph-model-type-doppio`.
     *
     * Aggrega qui e non su `ratings()` anche per un secondo motivo: `value` sta sul
     * pivot, non su `ratings`, quindi `sum('ratings', 'value')` è un errore SQL
     * (`Unknown column 'ratings.value'`).
     *
     * @return HasMany<MorphPivot, TModel>
     */
    public function ratingMorphs(): HasMany
    {
        $pivot = $this->guessMorphPivot($this->resolveRatingClass());

        /** @var HasMany<MorphPivot, TModel> $relation */
        $relation = $this->hasMany($pivot::class, 'model_id', $this->getKeyName())
            ->whereIn('model_type', array_unique([$this->getMorphClass(), static::class]));

        return $relation;
    }

    /**
>>>>>>> .merge_file_Obnfis
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function ratings(): MorphToMany
    {
        /** @var class-string<BaseRating> $related */
<<<<<<< .merge_file_85B2Nz
        $related = Rating::getClassName();
=======
        $related = $this->resolveRatingClass();
>>>>>>> .merge_file_Obnfis
        Assert::subclassOf($related, BaseRating::class);

        /** @var MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'> $relation */
        $relation = $this->morphToManyX($related, 'model');

        return $relation;
    }

    /**
     * Obiettivi rating con aggregati (count, avg, voto utente corrente).
     *
     * @return HasMany<BaseRating, TModel>
     */
    public function ratingObjectives(): HasMany
    {
        $userId = Auth::id();
<<<<<<< .merge_file_85B2Nz

        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
        Assert::subclassOf($related, BaseRating::class);

=======

        /** @var class-string<BaseRating> $related */
        $related = $this->resolveRatingClass();
        Assert::subclassOf($related, BaseRating::class);

>>>>>>> .merge_file_Obnfis
        /** @var HasMany<BaseRating, TModel> $query */
        $query = $this->hasMany($related, 'related_type', 'post_type')
            ->selectRaw(
                'ratings.*,
                count(value) as rating_count,
                avg(value) as rating_avg,
                sum(if(user_id = ?, value, 0)) AS rating_my',
                [$userId]
            )->leftJoin(
                'rating_morph',
                function (JoinClause $join): void {
                    $join->on('rating_morph.rating_id', 'ratings.id')
                        ->whereColumn('rating_morph.post_type', 'ratings.related_type')
                        ->where('rating_morph.post_id', $this->getKey());
                }
            )->groupBy('ratings.id')
            ->with('post');

        return $query;
    }

    /**
<<<<<<< .merge_file_85B2Nz
     * @param  Builder<TModel>  $query
=======
     * @param Builder<TModel> $query
     *
>>>>>>> .merge_file_Obnfis
     * @return Builder<TModel>
     */
    public function scopeWithRating(Builder $query): Builder
    {
        return $query->leftJoin(
            'rating_morph',
            function (JoinClause $join): void {
                $join->on('rating_morph.post_type', '=', 'ratings.related_type');
            }
        );
    }

    /**
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function myRatings(): MorphToMany
    {
        $userId = Auth::id();

        /** @var class-string<BaseRating> $related */
<<<<<<< .merge_file_85B2Nz
        $related = Rating::getClassName();
=======
        $related = $this->resolveRatingClass();
>>>>>>> .merge_file_Obnfis
        Assert::subclassOf($related, BaseRating::class);

        /** @var MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'> $query */
        $query = $this->morphToManyX($related, 'model')
            ->wherePivot('user_id', $userId);

        return $query;
    }

    /**
     * @return Collection<string|int, mixed>
     */
    public function getMyRatingAttribute(): Collection
    {
        /** @var Collection<int, BaseRating> $myRatings */
        $myRatings = $this->myRatings;

        return $myRatings->pluck('pivot.rating', 'post_id');
    }

    public function getRatingsAvgAttribute(?float $value): ?float
    {
        return (float) ($value ?? 0);
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
        return $value ?? 0;
    }

    /**
<<<<<<< .merge_file_85B2Nz
     * @param  array<string, mixed>  $filters
=======
     * @param array<string, mixed> $filters
     *
>>>>>>> .merge_file_Obnfis
     * @return Collection<int, BaseRating>
     */
    public function getRatingsWhere(array $filters): Collection
    {
        $query = $this->ratings();

        foreach ($filters as $key => $filterValue) {
            $query->where("extra_attributes->{$key}", $filterValue);
        }

        /** @var Collection<int, BaseRating> $result */
        $result = $query->get();

        return $result;
    }

    /**
     * Sync pivot verso rating che matchano extra_attributes.
<<<<<<< .merge_file_85B2Nz
     *
     * @param  array<string, mixed>  $where
=======
     *
     * @param array<string, mixed> $where
     *
>>>>>>> .merge_file_Obnfis
     * @return Collection<int, BaseRating>
     */
    public function syncRatingsWhere(array $where): Collection
    {
        /** @var class-string<BaseRating> $ratingClass */
<<<<<<< .merge_file_85B2Nz
        $ratingClass = Rating::getClassName();
=======
        $ratingClass = $this->resolveRatingClass();
>>>>>>> .merge_file_Obnfis
        Assert::subclassOf($ratingClass, BaseRating::class);

        $ratings = $ratingClass::withExtraAttributes($where)->get();
        /*
        dddx([
            'ratings' => $ratings,
            'where' => $where,
        ]);
        */
        /** @var list<int|string> $ratingIds */
        $ratingIds = $ratings->pluck('id')->all();

<<<<<<< .merge_file_85B2Nz
        if ($ratingIds !== []) {
=======
        if ([] !== $ratingIds) {
>>>>>>> .merge_file_Obnfis
            $this->ratings()->sync($ratingIds);
        }

        /** @var Collection<int, BaseRating> $result */
        $result = $this->ratings;

        return $result;
    }

    /**
     * @throws FileNotFoundException
     * @throws \ReflectionException
     */
    public function ratingAvgHtml(): string
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        $pivotAvg = $safeStringCastAction->execute($this->ratings_avg ?? 0);
        $pivotCount = $safeStringCastAction->execute($this->ratings_count ?? 0);
        $title = 'Vota '.$safeStringCastAction->execute($this->title ?? '');

        $msg = '<div class="rateit" data-rateit-value="'.$pivotAvg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivotAvg.') '.$pivotCount.' Votes ';

        $ratingUrl = '#';

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btnIframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btnIframe;
<<<<<<< .merge_file_85B2Nz
    }

    /**
     * Il nome del campo di form che corrisponde a una riga di `ratings`.
     *
     * Convenzione unica, condivisa fra chi costruisce lo schema, chi legge lo stato e chi
     * salva le pivot: se cambia, cambia in un posto solo.
     */
    public static function ratingFieldName(BaseRating $rating): string
    {
        return 'ratings.'.$rating->id.'.pivot.value';
    }

    /**
     * Costruisce i campi di form a partire dalle righe di `ratings`.
     *
     * Il trait decide il **generale**: che una riga diventa un campo, che le righe con
     * `is_readonly` sono in sola lettura, il nome del campo, la regola di validazione presa
     * da `ratings.rule`, la reattività.
     *
     * Il **particolare** — etichetta, formato denaro, colonne, valore di default, e
     * soprattutto il ricalcolo dei campi readonly — resta dell'host e arriva da
     * {@see RatingsFormCallerContract}. È un'interfaccia e non un `method_exists` su un nome
     * dedotto perché dedurre il comportamento da una stringa è esattamente il difetto che
     * questa estrazione non deve promuovere a piattaforma: `Rating` è consumato da sei moduli.
     *
     * Il trait **non chiama mai** `->label()`. L'etichetta di un rating è un dato
     * (`txt`/`title`), non una costante, e la regola `no-filament-labels` non ammette
     * eccezioni: finché quella tensione non è decisa, resta dove già era — nell'host,
     * dentro `decorateRatingField()`. Vedi la decisione D-1 della story 5.92.
     *
     * Senza `$caller` lo schema è comunque valido: manca solo il particolare.
     *
     * @param  EloquentCollection<int, BaseRating>|null  $ratings  se null usa `$this->ratings`
     * @return array<string, Component> indicizzato per nome di campo
     */
    /**
     * I criteri che diventano campi: tutti tranne le opzioni.
     *
     * Un criterio con `parent_id` e' una voce del `Select` del padre, non un campo suo.
     * Pubblico perche' chi somma deve escludere le stesse righe: vedi `getTot()` di
     * IndennitaResponsabilita. Due definizioni di «opzione» prima o poi divergono.
     *
     * @param  EloquentCollection<int, BaseRating>|null  $ratings  se null usa `$this->ratings`
     * @return Collection<int, BaseRating>
     */
    public function ratingFormFields(?EloquentCollection $ratings = null): Collection
    {
        return ($ratings ?? $this->ratings)
            ->unique('id')
            ->reject(static fn (BaseRating $row): bool => $row->parent_id !== null);
    }

    /**
     * @param  EloquentCollection<int, BaseRating>|null  $ratings  se null usa `$this->ratings`
     * @return array<string, Component> indicizzato per nome di campo
     */
    public function getRatingsFormSchema(?RatingsFormCallerContract $caller = null, ?EloquentCollection $ratings = null): array
    {
        /** @var EloquentCollection<int, BaseRating> $rows */
        $rows = $ratings ?? $this->ratings;

        // Una query sola per tutti i figli: dentro il ciclo sarebbe una per criterio.
        $rows->loadMissing('children');

        $fields = $this->ratingFormFields($rows);

        /** @var Collection<int, BaseRating> $readonlyRatings */
        $readonlyRatings = $fields->where('is_readonly', true);

        $schema = [];
        foreach ($fields as $rating) {
            $component = $this->buildRatingComponent($rating, $caller, $readonlyRatings);

            $schema[self::ratingFieldName($rating)] = $caller?->decorateRatingField($rating, $component) ?? $component;
        }

        return $schema;
    }

    /**
     * Il campo di una riga, prima della decorazione dell'host.
     *
     * Sola lettura: `TextEntry`. Modificabile: `Select` se il criterio elenca dei figli,
     * altrimenti `TextInput`. Cambia solo il costruttore — regola di validazione presa dal
     * dato e gancio di ricalcolo sono in coda, scritti una volta sola: quando il gancio
     * viveva dentro il ramo del `TextInput`, il `Select` aggiunto dopo e' nato muto.
     *
     * @param  Collection<int, BaseRating>  $readonlyRatings
     */
    private function buildRatingComponent(
        BaseRating $rating,
        ?RatingsFormCallerContract $caller,
        Collection $readonlyRatings,
    ): Component {
        $field = self::ratingFieldName($rating);

        if ($rating->is_readonly === true) {
            return TextEntry::make($field)->inlineLabel();
        }

        // `getLabel()` e non `title`: e' il model a dire come si chiama, e restituisce
        // sempre una stringa — `pluck('title')` ne restituirebbe anche di nulle.
        $options = $rating->children
            ->mapWithKeys(static fn (BaseRating $child): array => [$child->id => $child->getLabel()])
            ->all();

        $component = $options === []
            ? TextInput::make($field)->numeric()->live(onBlur: true)
            : Select::make($field)->options($options)->live();

        return $component
            ->nullable()
            ->inlineLabel()
            ->rules((string) ($rating->rule->value ?? ''))
            ->afterStateUpdated(
                static function (Set $set, Get $get) use ($caller, $readonlyRatings): void {
                    $caller?->recalculateRatingFields($set, $get, $readonlyRatings);
                }
            );
=======
>>>>>>> .merge_file_Obnfis
    }

    /**
     * @return array<string, string>
     */
    public function getRatingsRules(string $prefix, string $postfix): array
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        /** @var Collection<int, BaseRating> $rows */
        $rows = $this->ratings;
        $res = [];

        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            $ruleStr = $this->ratingRuleToString($row->rule, $safeStringCastAction);

            if (Str::contains($ruleStr, ['numeric', 'integer']) && ! Str::contains($ruleStr, 'nullable')) {
                $ruleStr = 'nullable|'.$ruleStr;
            }

            $res[$keyWithPostfix] = $ruleStr;
        }

        return $res;
    }

    private function ratingRuleToString(mixed $rule, SafeStringCastAction $safeStringCastAction): string
    {
        if ($rule instanceof \BackedEnum) {
            return $safeStringCastAction->execute($rule->value);
        }

        return $safeStringCastAction->execute($rule);
    }

    /**
     * @return array<string, string>
     */
    public function getRatingsValidationAttributes(string $prefix, string $postfix): array
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        /** @var Collection<int, BaseRating> $rows */
        $rows = $this->ratings;
        $res = [];

        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            $res[$keyWithPostfix] = $safeStringCastAction->execute($row->title ?? '');
        }

        return $res;
    }
}
