<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Rating\Models\Rating;
use Modules\Rating\Enums\RuleEnum;

class RatingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // Crea 20+ ratings per testing homepage e widget
        $ratings = [
            // Rating 1-5 stelle
            ['title' => '1 Stella', 'color' => '#EF4444', 'icon' => 'heroicon-o-star', 'rule' => RuleEnum::STAR_1, 'txt' => 'Molto negativo'],
            ['title' => '2 Stelle', 'color' => '#F97316', 'icon' => 'heroicon-o-star', 'rule' => RuleEnum::STAR_2, 'txt' => 'Negativo'],
            ['title' => '3 Stelle', 'color' => '#FBBF24', 'icon' => 'heroicon-o-star', 'rule' => RuleEnum::STAR_3, 'txt' => 'Neutro'],
            ['title' => '4 Stelle', 'color' => '#84CC16', 'icon' => 'heroicon-o-star', 'rule' => RuleEnum::STAR_4, 'txt' => 'Positivo'],
            ['title' => '5 Stelle', 'color' => '#22C55E', 'icon' => 'heroicon-o-star', 'rule' => RuleEnum::STAR_5, 'txt' => 'Molto positivo'],

            // Rating emoticon
            ['title' => 'Molto Triste', 'color' => '#6366F1', 'icon' => 'heroicon-o-face-frown', 'rule' => RuleEnum::SAD_VERY, 'txt' => 'Estremamente negativo'],
            ['title' => 'Triste', 'color' => '#8B5CF6', 'icon' => 'heroicon-o-face-frown', 'rule' => RuleEnum::SAD, 'txt' => 'Negativo'],
            ['title' => 'Neutro', 'color' => '#A855F7', 'icon' => 'heroicon-o-face-meh', 'rule' => RuleEnum::NEUTRAL, 'txt' => 'Né positivo né negativo'],
            ['title' => 'Felice', 'color' => '#D946EF', 'icon' => 'heroicon-o-face-smile', 'rule' => RuleEnum::HAPPY, 'txt' => 'Positivo'],
            ['title' => 'Molto Felice', 'color' => '#EC4899', 'icon' => 'heroicon-o-face-smile', 'rule' => RuleEnum::HAPPY_VERY, 'txt' => 'Estremamente positivo'],

            // Rating like/dislike
            ['title' => 'Non mi piace', 'color' => '#DC2626', 'icon' => 'heroicon-o-thumb-down', 'rule' => RuleEnum::DISLIKE, 'txt' => 'Feedback negativo'],
            ['title' => 'Mi piace', 'color' => '#16A34A', 'icon' => 'heroicon-o-thumb-up', 'rule' => RuleEnum::LIKE, 'txt' => 'Feedback positivo'],

            // Rating sì/no
            ['title' => 'No', 'color' => '#B91C1C', 'icon' => 'heroicon-o-x-circle', 'rule' => RuleEnum::NO, 'txt' => 'Risposta negativa'],
            ['title' => 'Sì', 'color' => '#15803D', 'icon' => 'heroicon-o-check-circle', 'rule' => RuleEnum::YES, 'txt' => 'Risposta affermativa'],

            // Rating priorità
            ['title' => 'Bassa Priorità', 'color' => '#0EA5E9', 'icon' => 'heroicon-o-arrow-down', 'rule' => RuleEnum::PRIORITY_LOW, 'txt' => 'Priorità minima'],
            ['title' => 'Media Priorità', 'color' => '#6366F1', 'icon' => 'heroicon-o-minus', 'rule' => RuleEnum::PRIORITY_MEDIUM, 'txt' => 'Priorità normale'],
            ['title' => 'Alta Priorità', 'color' => '#F59E0B', 'icon' => 'heroicon-o-arrow-up', 'rule' => RuleEnum::PRIORITY_HIGH, 'txt' => 'Priorità elevata'],
            ['title' => 'Critica', 'color' => '#DC2626', 'icon' => 'heroicon-o-exclamation-circle', 'rule' => RuleEnum::PRIORITY_CRITICAL, 'txt' => 'Priorità massima'],

            // Rating difficoltà
            ['title' => 'Molto Facile', 'color' => '#22C55E', 'icon' => 'heroicon-o-bolt', 'rule' => RuleEnum::DIFFICULTY_VERY_EASY, 'txt' => 'Nessuna difficoltà'],
            ['title' => 'Facile', 'color' => '#84CC16', 'icon' => 'heroicon-o-smiley', 'rule' => RuleEnum::DIFFICULTY_EASY, 'txt' => 'Poca difficoltà'],
            ['title' => 'Medio', 'color' => '#FBBF24', 'icon' => 'heroicon-o-face-meh', 'rule' => RuleEnum::DIFFICULTY_MEDIUM, 'txt' => 'Difficoltà normale'],
            ['title' => 'Difficile', 'color' => '#F97316', 'icon' => 'heroicon-o-face-frown', 'rule' => RuleEnum::DIFFICULTY_HARD, 'txt' => 'Molta difficoltà'],
            ['title' => 'Molto Difficile', 'color' => '#DC2626', 'icon' => 'heroicon-o-fire', 'rule' => RuleEnum::DIFFICULTY_VERY_HARD, 'txt' => 'Estrema difficoltà'],

            // Rating completamento
            ['title' => 'Non Completato', 'color' => '#6B7280', 'icon' => 'heroicon-o-circle', 'rule' => RuleEnum::COMPLETION_NONE, 'txt' => '0% completato'],
            ['title' => 'Parziale (25%)', 'color' => '#3B82F6', 'icon' => 'heroicon-o-circle-half', 'rule' => RuleEnum::COMPLETION_QUARTER, 'txt' => '25% completato'],
            ['title' => 'Metà (50%)', 'color' => '#8B5CF6', 'icon' => 'heroicon-o-circle-half', 'rule' => RuleEnum::COMPLETION_HALF, 'txt' => '50% completato'],
            ['title' => 'Quasi Completo (75%)', 'color' => '#A855F7', 'icon' => 'heroicon-o-circle-check', 'rule' => RuleEnum::COMPLETION_THREE_QUARTER, 'txt' => '75% completato'],
            ['title' => 'Completato', 'color' => '#10B981', 'icon' => 'heroicon-o-check-circle', 'rule' => RuleEnum::COMPLETION_FULL, 'txt' => '100% completato'],
        ];

        foreach ($ratings as $index => $ratingData) {
            Rating::create([
                'title' => $ratingData['title'],
                'color' => $ratingData['color'],
                'icon' => $ratingData['icon'],
                'rule' => $ratingData['rule'],
                'txt' => $ratingData['txt'],
                'order_column' => $index + 1,
                'is_disabled' => false,
                'is_readonly' => false,
            ]);
        }

        $this->command->info("Creati ".count($ratings)." ratings con successo!");
    }
}
