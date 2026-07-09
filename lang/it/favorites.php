<?php

declare(strict_types=1);

// Rating translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Rating/docs/wiki — domain i18n only.
// File: lang/it/favorites.php
return [
    'favorites' => 'I tuoi favoriti',
    'q' => [
        'label' => 'Cerca',
        'placeholder' => 'Cerca',
    ],
    'start_with' => ['placeholder' => 'Inizia con...'],
    'without' => ['placeholder' => 'Escludi'],
];
