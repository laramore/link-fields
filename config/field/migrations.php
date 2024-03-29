<?php

namespace Laramore\Fields;

return [

    /*
    |--------------------------------------------------------------------------
    | Default text fields
    |--------------------------------------------------------------------------
    |
    | This option defines the default text fields.
    |
    */

    Append::class => null,
    ClassName::class => [
        'type' => 'char',
        'property_keys' => [
            'length', 'nullable', 'default',
        ],
    ],
    Counter::class => [
        'type' => 'integer',
        'property_keys' => [
            'nullable', 'default',
        ],
    ],
    ModelEnum::class => [
        'type' => 'enum',
        'property_keys' => [
            'allowed:values', 'length', 'nullable', 'default:defaultValue',
        ],
    ],
    ModelName::class => [
        'type' => 'char',
        'property_keys' => [
            'length', 'nullable', 'default',
        ],
    ],
    RelationToOne::class => null,
    RelationToMany::class => null,
    ReversedRelation::class => null,
    Slugify::class => [
        'type' => 'char',
        'property_keys' => [
            'length', 'nullable', 'default',
        ],
    ],

];
