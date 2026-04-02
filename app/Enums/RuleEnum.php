<?php

declare(strict_types=1);

namespace Modules\Rating\Enums;

use Filament\Support\Contracts\HasLabel;

enum RuleEnum: string implements HasLabel
{
    // Legacy rules
    case Null = '';
    case ZeroFive = 'numeric|min:0|max:5';
    case ZeroOrMin4Max25 = 'min:0|max:25|not_in:1,2,3';
    case NullableNumericMin0Max25 = 'nullable|numeric|min:0|max:25';

    // Star ratings (1-5)
    case STAR_1 = 'star_1';
    case STAR_2 = 'star_2';
    case STAR_3 = 'star_3';
    case STAR_4 = 'star_4';
    case STAR_5 = 'star_5';

    // Emotion ratings
    case SAD_VERY = 'sad_very';
    case SAD = 'sad';
    case NEUTRAL = 'neutral';
    case HAPPY = 'happy';
    case HAPPY_VERY = 'happy_very';

    // Like/Dislike
    case DISLIKE = 'dislike';
    case LIKE = 'like';

    // Yes/No
    case NO = 'no';
    case YES = 'yes';

    // Priority levels
    case PRIORITY_LOW = 'priority_low';
    case PRIORITY_MEDIUM = 'priority_medium';
    case PRIORITY_HIGH = 'priority_high';
    case PRIORITY_CRITICAL = 'priority_critical';

    // Difficulty levels
    case DIFFICULTY_VERY_EASY = 'difficulty_very_easy';
    case DIFFICULTY_EASY = 'difficulty_easy';
    case DIFFICULTY_MEDIUM = 'difficulty_medium';
    case DIFFICULTY_HARD = 'difficulty_hard';
    case DIFFICULTY_VERY_HARD = 'difficulty_very_hard';

    // Completion status
    case COMPLETION_NONE = 'completion_none';
    case COMPLETION_QUARTER = 'completion_quarter';
    case COMPLETION_HALF = 'completion_half';
    case COMPLETION_THREE_QUARTER = 'completion_three_quarter';
    case COMPLETION_FULL = 'completion_full';

    public function getLabel(): string
    {
        return match ($this) {
            // Legacy
            self::Null => 'Nessuna regola',
            self::ZeroFive => '0-5 (Numerico)',
            self::ZeroOrMin4Max25 => '0 o 4-25',
            self::NullableNumericMin0Max25 => '0-25 (Opzionale)',

            // Stars
            self::STAR_1 => '1 Stella',
            self::STAR_2 => '2 Stelle',
            self::STAR_3 => '3 Stelle',
            self::STAR_4 => '4 Stelle',
            self::STAR_5 => '5 Stelle',

            // Emotions
            self::SAD_VERY => 'Molto Triste',
            self::SAD => 'Triste',
            self::NEUTRAL => 'Neutro',
            self::HAPPY => 'Felice',
            self::HAPPY_VERY => 'Molto Felice',

            // Like/Dislike
            self::DISLIKE => 'Non mi piace',
            self::LIKE => 'Mi piace',

            // Yes/No
            self::NO => 'No',
            self::YES => 'Sì',

            // Priority
            self::PRIORITY_LOW => 'Bassa Priorità',
            self::PRIORITY_MEDIUM => 'Media Priorità',
            self::PRIORITY_HIGH => 'Alta Priorità',
            self::PRIORITY_CRITICAL => 'Critica',

            // Difficulty
            self::DIFFICULTY_VERY_EASY => 'Molto Facile',
            self::DIFFICULTY_EASY => 'Facile',
            self::DIFFICULTY_MEDIUM => 'Medio',
            self::DIFFICULTY_HARD => 'Difficile',
            self::DIFFICULTY_VERY_HARD => 'Molto Difficile',

            // Completion
            self::COMPLETION_NONE => 'Non Completato',
            self::COMPLETION_QUARTER => 'Parziale (25%)',
            self::COMPLETION_HALF => 'Metà (50%)',
            self::COMPLETION_THREE_QUARTER => 'Quasi Completo (75%)',
            self::COMPLETION_FULL => 'Completato',
        };
    }
}
