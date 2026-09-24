<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Widgets;

<<<<<<< HEAD
=======
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
>>>>>>> 77b9106 (.)
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Rating\Actions\HasRating\GetCountByModelRatingIdAction;
use Modules\Rating\Actions\HasRating\GetSumByModelRatingIdAction;
use Modules\Rating\Models\Contracts\HasRatingContract;
use Modules\Rating\Models\Rating;
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Xot\Actions\Cast\SafeStringCastAction;
=======
>>>>>>> e8cf105 (Check & fix styling)
use Modules\Xot\Filament\Widgets\XotBaseStatsOverviewWidget as BaseWidget;
=======
>>>>>>> 77b9106 (.)
use Webmozart\Assert\Assert;

/**
 * @property (Model&HasRatingContract)|null $record
 */
class StatsOverview extends BaseWidget
{
    public (Model&HasRatingContract)|null $record = null;

    protected function getStats(): array
    {
        $stats = [];
        if (null === $this->record) {
            return $stats;
        }
        $ratings = $this->record->ratings()->wherePivot('user_id', null)->get();
        Assert::isInstanceOf($ratings, Collection::class);
        Assert::allIsInstanceOf($ratings, Rating::class);
        foreach ($ratings as $rating) {
<<<<<<< HEAD
<<<<<<< HEAD
            $sum = app(GetSumByModelRatingIdAction::class)->execute($this->record, SafeStringCastAction::cast($rating->id));
            $count = app(GetCountByModelRatingIdAction::class)->execute($this->record, SafeStringCastAction::cast($rating->id));
            $stats[] = Stat::make(SafeStringCastAction::cast($rating->title), $sum)->descriptionIcon('heroicon-o-circle-stack')->description('volume');
            $stats[] = Stat::make(SafeStringCastAction::cast($rating->title), $count)->descriptionIcon('heroicon-o-users')->description('players')->color('success');
=======
=======
>>>>>>> 77b9106 (.)
            $sum = app(GetSumByModelRatingIdAction::class)->execute($this->record, (string) $rating->id);
            $count = app(GetCountByModelRatingIdAction::class)->execute($this->record, (string) $rating->id);
            $stats[] = Stat::make((string) $rating->title, $sum)->descriptionIcon('predict-bottlecap')->description('volume');
            $stats[] = Stat::make((string) $rating->title, $count)->descriptionIcon('heroicon-o-users')->description('players')->color('success');
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
        }

        $sum = app(GetSumByModelRatingIdAction::class)->execute($this->record);
        $count = app(GetCountByModelRatingIdAction::class)->execute($this->record);
<<<<<<< HEAD
<<<<<<< HEAD
        $stats[] = Stat::make('Tot Volume', $sum)->descriptionIcon('heroicon-o-circle-stack')->description('volume');
=======
        $stats[] = Stat::make('Tot Volume', $sum)->descriptionIcon('predict-bottlecap')->description('volume');
>>>>>>> e8cf105 (Check & fix styling)
=======
        $stats[] = Stat::make('Tot Volume', $sum)->descriptionIcon('predict-bottlecap')->description('volume');
>>>>>>> 77b9106 (.)
        $stats[] = Stat::make('Tot Player', $count)->descriptionIcon('heroicon-o-users')->description('players')->color('success');

        return $stats;
    }
}
