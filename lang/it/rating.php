<?php

declare(strict_types=1);

return [
    'resource' => [
        'name' => [
            'label' => 'Rating',
        ],
    ],
    'navigation' => [
        'name' => [
            'label' => 'Rating',
        ],
        'plural' => [
            'label' => 'Rating',
        ],
        'group' => [
            'name' => [
                'label' => 'Admin',
            ],
        ],
        'sort' => 33,
    ],
    'fields' => [
        'brand' => [
            'label' => 'Marca',
        ],
        'model' => [
            'label' => 'Modello',
        ],
        'description' => [
            'label' => 'Descrizione',
        ],
        'serial_number' => [
            'label' => 'Numero di serie',
        ],
        'inventory_number' => [
            'label' => 'Codice inventario',
        ],
        'code' => [
            'label' => 'Identificativo',
        ],
        'manufacturing_year' => [
            'label' => 'Anno di fabbricazione',
        ],
        'purchase_year' => [
            'label' => 'Anno di acquisto',
        ],
        'is_enabled' => [
            'label' => 'È attivo?',
        ],
        'asset_type' => [
            'label' => 'Tipologia',
        ],
        'area' => [
            'label' => 'Area',
        ],
        'parent' => [
            'label' => 'Asset genitore',
        ],
        'name' => [
            'label' => 'Nome',
        ],
        'is_disabled' => [
            'label' => 'is_disabled',
        ],
        'is_readonly' => [
            'label' => 'is_readonly',
        ],
        '_tpl' => [
            'label' => '_tpl',
        ],
        'ratings' => [
            'label' => 'ratings',
        ],
        'id' => [
            'label' => 'id',
        ],
        'title' => [
            'label' => 'title',
        ],
        'color' => [
            'label' => 'color',
        ],
        'rating' => [
            'label' => 'rating',
            'description' => 'rating',
            'helper_text' => 'rating',
        ],
        'view' => [
            'label' => 'view',
        ],
        'anno' => [
            'label' => 'anno',
        ],
        'type' => [
            'label' => 'type',
        ],
    ],
    'actions' => [
        'enable' => [
            'cta' => [
                'label' => 'Attiva',
            ],
            'label' => [
                'label' => 'Attiva',
            ],
        ],
        'disable' => [
            'cta' => [
                'label' => 'Dismetti',
            ],
            'label' => [
                'label' => 'Dismetti',
            ],
        ],
        'import' => [
            'row_number' => [
                'label' => 'Riga :row',
            ],
            'label' => [
                'label' => 'Importa',
            ],
            'fields' => [
                'import_file' => [
                    'label' => 'Seleziona un file XLS o CSV da caricare',
                ],
            ],
        ],
        'export' => [
            'filename_prefix' => [
                'label' => 'Lista asset al',
            ],
            'label' => [
                'label' => 'Esporta',
            ],
            'columns' => [
                'brand' => [
                    'label' => 'Marca',
                ],
                'model' => [
                    'label' => 'Modello',
                ],
                'description' => [
                    'label' => 'Descrizione',
                ],
                'serial_number' => [
                    'label' => 'Numero di serie',
                ],
                'inventory_number' => [
                    'label' => 'Codice inventario',
                ],
                'code' => [
                    'label' => 'Identificativo',
                ],
                'manufacturing_year' => [
                    'label' => 'Anno di fabbricazione',
                ],
                'purchase_year' => [
                    'label' => 'Anno di acquisto',
                ],
                'is_enabled' => [
                    'label' => 'È attivo?',
                ],
                'asset_type' => [
                    'label' => 'Tipologia',
                ],
                'parent_inventory_number' => [
                    'label' => 'Codice inventario genitore',
                ],
            ],
        ],
        'delete' => [
            'tooltip' => 'delete',
            'icon' => 'delete',
            'label' => 'delete',
        ],
        'edit' => [
            'tooltip' => 'edit',
            'icon' => 'edit',
            'label' => 'edit',
        ],
    ],
    'widgets' => [
        'child_assets' => [
            'label' => 'Asset figli',
        ],
    ],
    'exceptions' => [
        'mandatory_data' => [
            'label' => '{1} Dato obbligatorio non presente|{2} 2 Dati obbligatori non presenti|{3} 3 Dati obbligatori non presenti|[4,*] Vari dati obbligatori non presenti',
        ],
    ],
];
