<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

<<<<<<< HEAD
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Rating\Contracts\RatingsFormCallerContract;
<<<<<<< HEAD
use Modules\Rating\Datas\RatingData;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Contracts\RatingContract;
<<<<<<< HEAD
=======
use Modules\Rating\Filament\Concerns\DecoratesRatingFormFields;
use Modules\Rating\Models\BaseRating;
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
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
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function ratings(): MorphToMany
    {
        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
<<<<<<< HEAD
<<<<<<< HEAD
        Assert::implementsInterface($related, RatingContract::class);
=======
        Assert::subclassOf($related, BaseRating::class);
>>>>>>> fd7a600 (.)
=======
        Assert::implementsInterface($related, RatingContract::class);
>>>>>>> laraxot/dev

        /** @var MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'> $relation */
        $relation = $this->morphToManyX($related, 'model');

        $relation = $relation->ordered();

        return $relation;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
     * `ratings` (morphToMany) e' indicizzata per posizione (0..N), non per id del
     * rating: `data_get($host, 'ratings.52')` non trova il rating con id 52.
     * Questo accessor re-indicizza per `id`, cosi' `data_get($host,
     * 'ratings_by_id.52.pivot.value')` funziona. Il voto vive sul pivot
     * (`rating_morph.value`), non sul model `ratings`.
     *
     * `ratings` vede solo la forma alias di `model_type` (vedi `ratingMorphs()`
     * sopra, story `rating-morph-model-type-doppio`): usata da sola perdeva il
     * pivot per ~228 host su 230. Il pivot arriva quindi da `ratingMorphs`
     * (entrambe le forme); il model `Rating` (per il title) resta quello gia'
     * caricato da `ratings` quando c'e', altrimenti un'istanza col solo `id` —
     * stesso limite gia' accettato da `RatingsColumn`.
     *
     * @return EloquentCollection<int|string, BaseRating>
     */
    public function getRatingsByIdAttribute(): EloquentCollection
    {
        /** @var EloquentCollection<int, BaseRating> $ratings */
        $ratings = $this->ratings->keyBy('id');

        /** @var Collection<int, MorphPivot> $pivots */
        $pivots = $this->ratingMorphs;

        /** @var EloquentCollection<int|string, BaseRating> $result */
        $result = new EloquentCollection();

        foreach ($pivots->groupBy('rating_id') as $ratingId => $group) {
            /** @var MorphPivot $pivot */
            $pivot = $group->first(static fn (MorphPivot $p): bool => null !== $p->getAttribute('value')) ?? $group->first();

            $rating = $ratings->get($ratingId);
            if (! $rating instanceof BaseRating) {
                // Carrier in-memory per una pivot orfana (rating non caricato in
                // `ratings`): serve solo ->id + accessors BaseRating, mai una query.
                // getClassName() fallisce da caller non-Models (test stub, fixtures).
                try {
                    /** @var class-string<BaseRating> $related */
                    $related = Rating::getClassName();
                } catch (\RuntimeException) {
                    $related = Rating::class;
                }
                Assert::implementsInterface($related, RatingContract::class);
                $rating = new $related();
                $rating->setRawAttributes(['id' => $ratingId]);
            }

            $rating = clone $rating;
            $rating->setRelation('pivot', $pivot);
            $result->put($ratingId, $rating);
        }

        return $result;
    }

    /**
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
     * Obiettivi rating con aggregati (count, avg, voto utente corrente).
     *
     * @return HasMany<BaseRating, TModel>
     */
    public function ratingObjectives(): HasMany
    {
        $userId = Auth::id();

        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
        Assert::implementsInterface($related, RatingContract::class);
=======
        Assert::subclassOf($related, BaseRating::class);
>>>>>>> fd7a600 (.)

        /** @var HasMany<BaseRating, TModel> $query */
        $query = $this->hasMany($related, 'related_type', 'post_type')
=======
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Rating\Models\Rating;

/**
 * Trait HasRatingsTrait.
 *
 * @see Modules/Rating/docs/schemaless-attributes.md
 */
/** @phpstan-ignore trait.unused */
trait HasRatingsTrait
{
    public function getRatingClass(): string
    {
        return (string) Str::of(static::class)
            ->before('\Models\\')
            ->append('\Models\Rating');
    }

    /**
     * Get ratings for this model.
     *
     * @return MorphToMany<Rating, static>
     */
    public function ratings(): MorphToMany
    {
        return $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph');
    }

    /**
     * Get rating objectives with aggregated data.
     *
     * @return HasMany<Rating, static>
     */
    public function ratingObjectives(): HasMany
    {
        $relatedClass = $this->getRatingClass();
        $userId = (int) Auth::id();

        return $this->hasMany($relatedClass, 'related_type', 'post_type')
>>>>>>> e8cf105 (Check & fix styling)
            ->selectRaw(
                'ratings.*,
                count(value) as rating_count,
                avg(value) as rating_avg,
                sum(if(user_id = ?, value, 0)) AS rating_my',
                [$userId]
            )->leftJoin(
                'rating_morph',
<<<<<<< HEAD
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
     * @param Builder<TModel> $query
     *
     * @return Builder<TModel>
=======
                function ($join): void {
                    $join->on('rating_morph.rating_id', 'ratings.id')
                        ->whereColumn('rating_morph.post_type', 'ratings.related_type')
                        ->where('rating_morph.post_id', $this->id);
                }
            )->groupBy('ratings.id')
            ->with('post');
    }

    /**
     * Scope a query to only include popular users.
>>>>>>> e8cf105 (Check & fix styling)
     */
    public function scopeWithRating(Builder $query): Builder
    {
        return $query->leftJoin(
            'rating_morph',
<<<<<<< HEAD
            function (JoinClause $join): void {
=======
            function ($join): void {
>>>>>>> e8cf105 (Check & fix styling)
                $join->on('rating_morph.post_type', '=', 'ratings.related_type');
            }
        );
    }

    /**
<<<<<<< HEAD
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function myRatings(): MorphToMany
    {
        $userId = Auth::id();

        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
<<<<<<< HEAD
<<<<<<< HEAD
        Assert::implementsInterface($related, RatingContract::class);
=======
        Assert::subclassOf($related, BaseRating::class);
>>>>>>> fd7a600 (.)
=======
        Assert::implementsInterface($related, RatingContract::class);
>>>>>>> laraxot/dev

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
=======
     * Get my ratings for this model.
     *
     * @return MorphToMany<Rating, static>
     */
    public function myRatings(): MorphToMany
    {
        return $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph')
            ->wherePivot('user_id', (string) Auth::id());
    }

    // ----- mutators -----
    // *
    public function getMyRatingAttribute(): Collection
    {
>>>>>>> e8cf105 (Check & fix styling)
        $myRatings = $this->myRatings;

        return $myRatings->pluck('pivot.rating', 'post_id');
    }

<<<<<<< HEAD
    public function getRatingsAvgAttribute(?float $value): ?float
    {
        return (float) ($value ?? 0);
=======
    /**
     * ----.
     */
    public function getRatingsAvgAttribute(?float $value): ?float
    {
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if (null !== $value) {
            // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
            if (null !== $this->getKey()) {
                $this->update(['ratings_avg' => $value]);
            }
        }

        return $value;
>>>>>>> e8cf105 (Check & fix styling)
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
<<<<<<< HEAD
        return $value ?? 0;
    }

    /**
     * @param array<string, mixed> $filters
     *
     * @return Collection<int, BaseRating>
     */
    public function getRatingsWhere(array $filters): Collection
    {
=======
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->count();
        $this->ratings_count = $value;

        // Guard: modello deve avere PK per salvare
        if (null == $this->getKey()) {
            return $value;
        }

        // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
        $this->update(['ratings_count' => $value]);

        return $value;
    }

    /**
     * Get ratings filtered by extra_attributes.
     *
     * @param array<string, mixed> $filters
     *
     * @return Collection<int, Rating>
     */
    public function getRatingsWhere(array $filters): Collection
    {
        /** @var Builder $query */
>>>>>>> e8cf105 (Check & fix styling)
        $query = $this->ratings();

        foreach ($filters as $key => $filterValue) {
            $query->where("extra_attributes->{$key}", $filterValue);
        }

<<<<<<< HEAD
        /** @var Collection<int, BaseRating> $result */
=======
        /** @var Collection<int, Rating> $result */
>>>>>>> e8cf105 (Check & fix styling)
        $result = $query->get();

        return $result;
    }

<<<<<<< HEAD
    /**
     * Sync pivot verso rating che matchano extra_attributes.
     *
     * @param array<string, mixed> $where
     *
     * @return Collection<int, BaseRating>
     */
    public function syncRatingsWhere(array $where): Collection
    {
        /** @var class-string<BaseRating> $ratingClass */
        $ratingClass = Rating::getClassName();
<<<<<<< HEAD
<<<<<<< HEAD
        Assert::implementsInterface($ratingClass, RatingContract::class);
=======
        Assert::subclassOf($ratingClass, BaseRating::class);
>>>>>>> fd7a600 (.)
=======
        Assert::implementsInterface($ratingClass, RatingContract::class);
>>>>>>> laraxot/dev

        $ratings = $ratingClass::withExtraAttributes($where)->get();
        /*
        dddx([
            'ratings' => $ratings,
            'where' => $where,
        ]);
        */
        /** @var list<int|string> $ratingIds */
        $ratingIds = $ratings->pluck('id')->all();

        if ([] !== $ratingIds) {
<<<<<<< HEAD
<<<<<<< HEAD
            // sync() DETACH + ATTACH: rischia di creare pivot alias vuoti e di non
            // toccare i FQCN legacy. Qui servono solo le associazioni mancanti.
            $this->ratings()->syncWithoutDetaching($ratingIds);
=======
            $this->ratings()->sync($ratingIds);
>>>>>>> fd7a600 (.)
=======
            // sync() DETACH + ATTACH: rischia di creare pivot alias vuoti e di non
            // toccare i FQCN legacy. Qui servono solo le associazioni mancanti.
            $this->ratings()->syncWithoutDetaching($ratingIds);
>>>>>>> laraxot/dev
        }

        /** @var Collection<int, BaseRating> $result */
        $result = $this->ratings;

        return $result;
    }

=======
    public function syncRatingsWhere(array $where): Collection
    {
        $ratings = app($this->getRatingClass())
            ->withExtraAttributes($where)
            ->get();

        $rating_ids = $ratings->modelKeys();
        $this->ratings()->sync($rating_ids);

        return $this->ratings;
    }

    // */
    /*
        public function setMyRatingAttribute($value){
        dddx($value);
        }
    */
    // ------ functions ------
>>>>>>> e8cf105 (Check & fix styling)
    /**
     * @throws FileNotFoundException
     * @throws \ReflectionException
     */
    public function ratingAvgHtml(): string
    {
<<<<<<< HEAD
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
    }

    /**
     * Chiave sentinella dell'opzione "altro" nel Select di un rating con figli.
     *
     * Stringa non vuota `'other'` — **non** `''`. Era `''` fino al 2026-09-16: bug reale
     * segnalato dall'utente (Textarea mai obbligatoria dopo aver scelto «altro»), causa
     * confermata leggendo il sorgente vendor, non ipotizzata:
     * `vendor/filament/support/resources/js/utilities/select.js` dichiara
     * `blank(value) { return value === null || value === undefined || value === '' || ... }`
     * e lo usa per decidere se mostrare il placeholder — il widget JS di Filament **non
     * distingue** lo stato "altro scelto" (`''`) da "nessuna scelta" (`null`), quindi lo
     * stato che arriva al server tramite Livewire collassa sempre su `null` e
     * {@see selectIsOther()} non ritorna mai `true`. Una stringa non vuota non passa mai
     * `blank()`, quindi resta distinguibile per tutto il ciclo JS→Livewire→PHP. Le chiavi
     * reali dei figli sono id interi, quindi nessuna stringa non vuota puo' mai collidere.
     * Decisione GitHub laraxot/module_rating_fila5#57 (design), #58 (implementazione),
     * #61 (review gate), issue di regressione per questo fix da aprire in fase di
     * documentazione. Nome inglese per l'identificatore e per il valore (coerente,
     * correzione utente 2026-09-16 sul codice sempre in inglese) — la label visibile
     * resta italiana via `trans('rating::fields.altro')` sotto, quello e' un valore di
     * dominio rivolto all'utente, non un identificatore.
     */
    private const string OTHER_OPTION_KEY = 'other';

    /**
     * True solo se lo stato del campo e' esattamente la sentinella "altro".
     *
     * Mai `blank()`: confonderebbe "altro" scelto con "nessuna scelta fatta" (`null`),
     * che devono restare due stati diversi del Select. Prende il valore gia' risolto
     * (non `Get`) cosi' resta testabile senza costruire un componente Filament vivo.
     */
    private static function selectIsOther(mixed $selectValue): bool
    {
        return self::OTHER_OPTION_KEY === $selectValue;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
     * Il nome del campo di form che corrisponde a una riga di `ratings`.
     *
     * Convenzione unica, condivisa fra chi costruisce lo schema, chi legge lo stato e chi
     * salva le pivot: se cambia, cambia in un posto solo. `$pivotColumn` resta `'value'`
     * per compatibilita: ogni chiamata esistente continua a puntare li; `'note'` e' la
     * sola altra colonna pivot che il trait genera oggi (vedi `buildRatingComponent()`).
     */
    public static function ratingFieldName(BaseRating $rating, string $pivotColumn = 'value'): string
    {
        return 'ratings.'.$rating->id.'.pivot.'.$pivotColumn;
    }

    /**
     * Testo etichetta form per un criterio: `txt` se presente, altrimenti `title`.
     *
     * Diverso da {@see BaseRating::getLabel()} (albero / solo `title`). Qui preferiamo
     * il testo lungo della scheda e togliamo HTML — convenzione condivisa da ogni host
     * che decora i campi (story 5.149). Il trait **non** chiama `->label()` Filament
     * (D-1): restituisce solo la stringa; l'host (o
     * {@see DecoratesRatingFormFields}) la applica.
     */
    public static function formFieldLabel(BaseRating $rating): string
    {
        return strip_tags((string) ($rating->txt ?? $rating->title));
    }

    /**
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
     * I criteri che diventano campi: tutti tranne le opzioni.
     *
     * Un criterio con `parent_id` e' una voce del `Select` del padre, non un campo suo.
     * Pubblico perche' chi somma deve escludere le stesse righe: vedi `getTot()` di
     * IndennitaResponsabilita. Due definizioni di «opzione» prima o poi divergono.
     *
     * @param EloquentCollection<int, BaseRating>|null $ratings se null usa `$this->ratings`
     *
     * @return Collection<int, BaseRating>
     */
    public function ratingFormFields(?EloquentCollection $ratings = null): Collection
    {
        return ($ratings ?? $this->ratings)
            ->unique('id')
<<<<<<< HEAD
<<<<<<< HEAD
            ->reject(static fn (RatingContract $row): bool => null !== $row->parent_id);
=======
            ->reject(static fn (BaseRating $row): bool => null !== $row->parent_id);
>>>>>>> fd7a600 (.)
=======
            ->reject(static fn (RatingContract $row): bool => null !== $row->parent_id);
>>>>>>> laraxot/dev
    }

    /**
     * Ricostruisce `ratings.{id}.pivot.{value,note}` da persistere nel form, per l'host
     * che chiama `$this->form->fill($data)`.
     *
     * Generico per costruzione: qualunque host che consuma {@see getRatingsFormSchema()}
     * deve ri-idratare lo stesso stato, incluso il remap dell'opzione "altro" — `value`
     * null + `note` valorizzata vuol dire che l'utente aveva scelto «altro» all'ultimo
     * salvataggio, quindi il Select deve ripartire su {@see OTHER_OPTION_KEY}, non su
     * `null` ("non ancora risposto"). Se questo remap vivesse in ogni host lo
     * riscriverebbe uguale o lo dimenticherebbe — stesso motivo per cui
<<<<<<< HEAD
<<<<<<< HEAD
     * `OTHER_OPTION_KEY` vive qui e `RatingData::ratingFieldName()` è la SSoT
     * del path form (non sull'host). Nato dal refactor 2026-09-16: prima
     * duplicato (parziale, solo `value`) dentro
=======
     * `ratingFieldName()`/`OTHER_OPTION_KEY` vivono qui e non nell'host. Nato dal
     * refactor 2026-09-16: prima duplicato (parziale, solo `value`) dentro
>>>>>>> fd7a600 (.)
=======
     * `OTHER_OPTION_KEY` vive qui e `RatingData::ratingFieldName()` è la SSoT
     * del path form (non sull'host). Nato dal refactor 2026-09-16: prima
     * duplicato (parziale, solo `value`) dentro
>>>>>>> laraxot/dev
     * `CompilaIndennitaResponsabilita::fillFormWithInitialData()`.
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function hydrateRatingsFormData(array $data): array
    {
        /** @var array<string, array{pivot: array{value: mixed, note: mixed}}> $ratingsData */
        $ratingsData = [];

        foreach ($this->ratings as $rating) {
            $id = (string) $rating->id;
            $value = $rating->pivot->value;
            $note = $rating->pivot->note;

            if (null === $value && filled($note)) {
                $value = self::OTHER_OPTION_KEY;
            }

            $ratingsData[$id]['pivot']['value'] = $value;
            $ratingsData[$id]['pivot']['note'] = $note;
        }

        $data['ratings'] = $ratingsData;

        return $data;
    }

    /**
     * Scrive `ratings.{id}.pivot.{value,note}` del form sul pivot, per l'host dentro
     * `save()`.
     *
     * Generico per lo stesso motivo di {@see hydrateRatingsFormData()}: `''` (opzione
     * «altro») e `null` (non risposto) vanno **entrambi** persistiti come `null` sulla
     * colonna numerica `value` — mai cast a `0`, che li renderebbe indistinguibili da un
     * voto reale zero e romperebbe `HasRatingValuesFilter` (D-8, story Rating/5.141).
     * Le altre chiavi pivot presenti nello stato del form (es. `note`) passano invariate.
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
     *
     * Scope: aggiorna SOLO le righe `rating_morph` di QUESTO host (`model_id` + entrambi
     * i `model_type` legacy alias|FQCN via {@see ratingMorphs()}). Non usare
     * `updateExistingPivot` da solo: vede solo `getMorphClass()` e lascia orfani i FQCN
     * (o crea duplicati alias). Mai un update globale su `rating_id` senza `model_id`.
=======
     * Nato dal refactor 2026-09-16: prima duplicato (con cast a `0`, il bug che questo
     * metodo corregge) dentro `CompilaIndennitaResponsabilita::save()`.
>>>>>>> fd7a600 (.)
     *
     * @param array<int|string, array{pivot?: array<string, mixed>}> $ratingsData
     */
    public function syncRatingsFormData(array $ratingsData): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
        if (null === $this->getKey()) {
            throw new \LogicException('syncRatingsFormData richiede un model_id persistito.');
        }

<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
        foreach ($ratingsData as $id => $rating) {
            $pivot = $rating['pivot'] ?? [];
            $value = $pivot['value'] ?? null;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
            $value = (self::OTHER_OPTION_KEY === $value || null === $value)
                ? null
                : (is_numeric($value) ? $value : null);

            /** @var array{value: int|float|string|null, note?: string|null} $payload */
            $payload = [
                'value' => $value,
            ];
            if (array_key_exists('note', $pivot)) {
                $note = $pivot['note'];
                $payload['note'] = is_string($note) || null === $note ? $note : null;
            }

            $updated = $this->ratingMorphs()
                ->where('rating_id', $id)
                ->update($payload);

            // Nessuna riga per questo host+rating: crea UNA sola pivot con morph corrente.
            if (0 === $updated) {
                $this->ratings()->attach($id, $payload);
            }
<<<<<<< HEAD
=======
            $pivot['value'] = (self::OTHER_OPTION_KEY === $value || null === $value)
                ? null
                : (is_numeric($value) ? $value : null);

            $this->ratings()->updateExistingPivot($id, $pivot);
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
     * Svuota la valutazione del record corrente: mette a `null` value e note su tutte
     * le pivot `rating_morph` gia' collegate a QUESTO `model_id` (alias + FQCN via
     * {@see ratingMorphs()}). Non tocca la scheda, non crea pivot, non fa sync/attach,
     * non cancella righe del catalogo `ratings`.
     *
     * Richiesta utente 2026-09-16: logica in HasRatingsTrait; Svuota UI solo header.
     */
    public function clearEvaluation(): void
    {
        if (null === $this->getKey()) {
            throw new \LogicException('clearEvaluation richiede un model_id persistito.');
        }

        $this->ratingMorphs()->update([
            'value' => null,
            'note' => null,
        ]);
    }

    /**
     * Alias di {@see clearEvaluation()} (editabili+readonly sullo stesso host).
     * Mantenuto per i caller che filtrano ancora per collection — lo scope resta
     * sempre `model_id` di `$this`; la collection e' ignorata di proposito (KISS:
     * azzerare tutta la relazione ratings del record, non un sottoinsieme fragile).
     *
     * @param EloquentCollection<int, BaseRating>|null $ratings ignorato (BC firma)
     */
    public function clearRatingsFormData(?EloquentCollection $ratings = null): void
    {
        $this->clearEvaluation();
    }

    /**
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
     * @param EloquentCollection<int, BaseRating>|null $ratings se null usa `$this->ratings`
     *
     * @return array<string, Component> indicizzato per nome di campo
     */
    public function getRatingsFormSchema(?RatingsFormCallerContract $caller = null, ?EloquentCollection $ratings = null): array
    {
        /** @var EloquentCollection<int, BaseRating> $rows */
        $rows = $ratings ?? $this->ratings;

        // Una query sola per tutti i figli: dentro il ciclo sarebbe una per criterio.
        $rows->loadMissing('children');

        $fields = $this->ratingFormFields($rows);

<<<<<<< HEAD
<<<<<<< HEAD
        /** @var Collection<int, RatingContract> $readonlyRatings */
=======
        /** @var Collection<int, BaseRating> $readonlyRatings */
>>>>>>> fd7a600 (.)
=======
        /** @var Collection<int, RatingContract> $readonlyRatings */
>>>>>>> laraxot/dev
        $readonlyRatings = $fields->where('is_readonly', true);

        $schema = [];
        foreach ($fields as $rating) {
            $component = $this->buildRatingComponent($rating, $caller, $readonlyRatings);

<<<<<<< HEAD
<<<<<<< HEAD
            $schema[RatingData::ratingFieldName($rating)] = $caller?->decorateRatingField($rating, $component) ?? $component;
=======
            $schema[self::ratingFieldName($rating)] = $caller?->decorateRatingField($rating, $component) ?? $component;
>>>>>>> fd7a600 (.)
=======
            $schema[RatingData::ratingFieldName($rating)] = $caller?->decorateRatingField($rating, $component) ?? $component;
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
     * @param Collection<int, RatingContract> $readonlyRatings
     */
    private function buildRatingComponent(
        RatingContract $rating,
        ?RatingsFormCallerContract $caller,
        Collection $readonlyRatings,
    ): Component {
        $field = RatingData::ratingFieldName($rating);
=======
     * @param Collection<int, BaseRating> $readonlyRatings
     */
    private function buildRatingComponent(
        BaseRating $rating,
        ?RatingsFormCallerContract $caller,
        Collection $readonlyRatings,
    ): Component {
        $field = self::ratingFieldName($rating);
>>>>>>> fd7a600 (.)

        if (true === $rating->is_readonly) {
            return TextEntry::make($field)->inlineLabel();
        }

        // `getLabel()` e non `title`: e' il model a dire come si chiama, e restituisce
        // sempre una stringa — `pluck('title')` ne restituirebbe anche di nulle.
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
        /** @var array<int, string> $options */
        $options = [];
        foreach ($rating->children as $child) {
            if (! $child instanceof RatingContract) {
                continue;
            }

            $options[$child->id] = $child->getLabel();
        }
=======
        $options = $rating->children
            ->mapWithKeys(static fn (BaseRating $child): array => [$child->id => $child->getLabel()])
            ->all();
>>>>>>> fd7a600 (.)

        $afterStateUpdated = static function (Set $set, Get $get) use ($caller, $readonlyRatings): void {
            $caller?->recalculateRatingFields($set, $get, $readonlyRatings);
        };

        // Messaggi errore: senza validationAttribute Filament stampa lo state path
        // («ratings.52.pivot.value»). API distinta da label() → non viola D-1 (5.151).
<<<<<<< HEAD
<<<<<<< HEAD
        $humanName = RatingData::formFieldLabel($rating);
=======
        $humanName = self::formFieldLabel($rating);
>>>>>>> fd7a600 (.)
=======
        $humanName = RatingData::formFieldLabel($rating);
>>>>>>> laraxot/dev

        if ([] === $options) {
            return TextInput::make($field)
                ->numeric()
                ->live(onBlur: true)
                ->nullable()
                ->inlineLabel()
                ->validationAttribute($humanName)
                ->rules((string) ($rating->rule->value ?? ''))
                ->afterStateUpdated($afterStateUpdated);
        }

        // "Altro" in coda alle opzioni reali: l'utente vede prima i figli, l'eccezione per ultima.
        $options[self::OTHER_OPTION_KEY] = trans('rating::fields.altro');

        // ->required() esplicito, non lasciato a ->rules($rating->rule->value): nessun
        // caso di RuleEnum contiene "required" (verificato leggendo l'enum) — un rating
        // con RuleEnum::Null o un rule futuro senza quella parola avrebbe reso il Select
        // scegliibile-o-no senza vincolo. Istruzione diretta dell'utente 2026-09-16.
        // Niente ->nullable(): in tensione con ->required() (nullable ammette il vuoto,
        // required lo vieta) — rimosso invece di farli convivere.
        //
        // Validazione chiavi: RuleEnum (numeric|min|max) vale per TextInput senza figli.
        // Su Select con figli la sentinella OTHER_OPTION_KEY ('other') NON è numerica —
        // applicarla qui faceva fallire il Select prima che la note potesse risultare
        // obbligatoria (bug utente 2026-09-16 / story 5.152). Chiavi stringate: Livewire
        // invia stringhe e Rule::in confronta in strict mode.
        $allowedSelectValues = array_map(
            static fn (int|string $key): string => (string) $key,
            array_keys($options),
        );

        $select = Select::make($field)
            ->options($options)
            ->hiddenLabel()
            ->validationAttribute($humanName)
            ->placeholder(trans('rating::fields.scegli'))
            ->live()
            ->required()
            ->rules([Rule::in($allowedSelectValues)])
            ->afterStateUpdated($afterStateUpdated);

        // SEMPRE visibile accanto al Select, mai nascosta. Required solo su «altro».
        // $get($select) passa il Component: Get risolve lo statePath reale (incl. `data.`
        // del form). $get($field, isAbsolute: true) toglieva il prefisso `data.` e
        // selectIsOther vedeva sempre null → note mai obbligatoria (bug utente 2026-09-16).
<<<<<<< HEAD
<<<<<<< HEAD
        $note = Textarea::make(RatingData::ratingFieldName($rating, 'note'))
            ->rows(3)
            ->hiddenLabel()
            ->validationAttribute(trans('rating::fields.note_for', [
                'label' => $humanName,
            ]))
=======
        $note = Textarea::make(self::ratingFieldName($rating, 'note'))
            ->rows(3)
            ->hiddenLabel()
            ->validationAttribute(trans('rating::fields.note_for', ['label' => $humanName]))
>>>>>>> fd7a600 (.)
=======
        $note = Textarea::make(RatingData::ratingFieldName($rating, 'note'))
            ->rows(3)
            ->hiddenLabel()
            ->validationAttribute(trans('rating::fields.note_for', [
                'label' => $humanName,
            ]))
>>>>>>> laraxot/dev
            ->required(static fn (Get $get): bool => self::selectIsOther($get($select)));

        // Fieldset Filament 5: label + bordo + columns(2) di default (setUp).
        // https://filamentphp.com/docs/5.x/schemas/layouts#fieldset-component
        // columnSpan(2): nel form parent (tipicamente columns(2)) il blocco Select|Textarea
        // occupa entrambe le colonne. Host: decorateRatingField → label() (D-1).
        // markAsRequired: Select ha hiddenLabel(), l'asterisco sul legend segnala obbligo.
        return Fieldset::make()
            ->columnSpan(2)
            ->markAsRequired()
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
            ->schema([
                $select,
                $note,
            ]);
<<<<<<< HEAD
=======
            ->schema([$select, $note]);
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
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

=======
        $pivot_avg = $this->ratings_avg;
        $pivot_cout = $this->ratings_count;

        $msg = '<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';

        $rating_url = '#';
        $title = 'Vota '.(isset($this->title) ? (string) $this->title : '');

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btn_iframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btn_iframe;
    }

    public function getRatingsRules(string $prefix, string $postfix): array
    {
        $rows = $this->ratings;
        $rules = $rows->mapWithKeys(function ($row) {
            $ruleValue = $row->rule instanceof \BackedEnum ? (string) $row->rule->value : (string) $row->rule;

            return [$row->id => $ruleValue];
        })->toArray();

        $rules = Arr::prependKeysWith($rules, $prefix);
        $res = [];
        foreach ($rules as $key => $ruleValue) {
            $keyWithPostfix = $key.$postfix;
            $ruleStr = (string) $ruleValue;

            // ✅ Se la regola è numeric o integer, aggiungi nullable se non presente
>>>>>>> e8cf105 (Check & fix styling)
            if (Str::contains($ruleStr, ['numeric', 'integer']) && ! Str::contains($ruleStr, 'nullable')) {
                $ruleStr = 'nullable|'.$ruleStr;
            }

            $res[$keyWithPostfix] = $ruleStr;
        }

        return $res;
    }

<<<<<<< HEAD
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
            $res[$keyWithPostfix] = $row instanceof BaseRating
<<<<<<< HEAD
<<<<<<< HEAD
                ? RatingData::formFieldLabel($row)
=======
                ? self::formFieldLabel($row)
>>>>>>> fd7a600 (.)
=======
                ? RatingData::formFieldLabel($row)
>>>>>>> laraxot/dev
                : $safeStringCastAction->execute($row->title ?? '');
=======
    public function getRatingsValidationAttributes(string $prefix, string $postfix): array
    {
        $rows = $this->ratings;
        $res = [];
        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$row->id.$postfix;
            $res[$keyWithPostfix] = (string) $row->title;
>>>>>>> e8cf105 (Check & fix styling)
        }

        return $res;
    }
}
