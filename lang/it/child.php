<?php

declare(strict_types=1);

return [
    'fields' => [
        'title' => ['label' => 'title', 'placeholder' => 'title', 'helper_text' => 'title', 'description' => 'title'],
        'slug' => ['label' => 'slug'],
        'children_count' => ['label' => 'children_count'],
        'is_disabled' => ['label' => 'is_disabled', 'placeholder' => 'is_disabled', 'helper_text' => 'is_disabled', 'description' => 'is_disabled'],
        'order_column' => ['label' => 'order_column', 'placeholder' => 'order_column', 'helper_text' => 'order_column', 'description' => 'order_column'],
        'rule' => ['label' => 'rule', 'placeholder' => 'rule', 'helper_text' => 'rule', 'description' => 'rule'],
    ],
    'actions' => [
        'create' => ['label' => 'create', 'icon' => 'create', 'tooltip' => 'create'],
        'edit' => ['label' => 'edit', 'icon' => 'edit', 'tooltip' => 'edit'],
        'delete' => ['label' => 'delete', 'icon' => 'delete', 'tooltip' => 'delete'],
    ],
];
