<?php

declare(strict_types=1);

return [
    'pages' => 'Pagine',
    'widgets' => 'Widget',
    'navigation' => [
        'name' => 'Rating Pivot',
        'plural' => 'Rating Pivot',
        'group' => [
            'name' => 'Gestione Rating',
        ],
        'label' => 'Rating Morph',
        'sort' => 6,
        'icon' => 'heroicon-o-star',
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help_text' => 'Nome univoco dell\'elemento',
        ],
        'guard_name' => [
            'label' => 'Guard',
            'placeholder' => 'Seleziona la guardia',
            'help_text' => 'Definisce il contesto di sicurezza',
        ],
        'permissions' => [
            'label' => 'Permessi',
            'placeholder' => 'Seleziona i permessi',
            'help_text' => 'Permessi associati all\'elemento',
        ],
        'updated_at' => [
            'label' => 'Aggiornato il',
            'help_text' => 'Data e ora dell\'ultimo aggiornamento',
        ],
        'first_name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
        ],
        'select_all' => [
            'label' => 'Seleziona Tutti',
            'message' => 'Seleziona tutti gli elementi disponibili',
        ],
    ],
    'actions' => [
        'import' => [
            'label' => 'Importa',
            'description' => 'Carica un file per importare dati',
            'fields' => [
                'import_file' => [
                    'label' => 'File da importare',
                    'placeholder' => 'Seleziona un file XLS o CSV',
                    'help_text' => 'Deve essere un file valido in formato CSV o Excel',
                ],
            ],
            'messages' => [
                'success' => 'Importazione completata con successo',
                'error' => 'Errore durante l\'importazione',
            ],
        ],
        'export' => [
            'label' => 'Esporta',
            'description' => 'Esporta i dati in un file',
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => [
                    'label' => 'Nome area',
                ],
                'parent_name' => [
                    'label' => 'Nome area livello superiore',
                ],
            ],
            'messages' => [
                'success' => 'Esportazione completata con successo',
                'error' => 'Errore durante l\'esportazione',
            ],
        ],
        'delete' => [
            'label' => 'Elimina',
            'confirmation' => 'Sei sicuro di voler eliminare questo elemento?',
            'messages' => [
                'success' => 'Elemento eliminato con successo',
                'error' => 'Errore durante l\'eliminazione',
            ],
        ],
        'edit' => [
            'label' => 'Modifica',
            'description' => 'Modifica i dettagli dell\'elemento',
            'messages' => [
                'success' => 'Modifica salvata con successo',
                'error' => 'Errore durante il salvataggio',
            ],
        ],
        'create' => [
            'label' => 'Crea',
            'description' => 'Aggiungi un nuovo elemento',
            'messages' => [
                'success' => 'Elemento creato con successo',
                'error' => 'Errore durante la creazione',
            ],
        ],
        'logout' => [
            'tooltip' => 'logout',
            'icon' => 'logout',
        ],
    ],
];
