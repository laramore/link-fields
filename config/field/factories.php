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

    Append::class => [
        'formater' => null,
    ],
    ClassName::class => [
        'formater' => 'randomElement',
    ],
    Counter::class => [
        'formater' => 'randomNumber',
    ],
    ModelEnum::class => [
        'formater' => 'randomElement',
    ],
    ModelName::class => [
        'formater' => 'randomElement',
    ],
    Relation::class => [
        'formater' => null,
    ],
    ReversedRelation::class => [
        'formater' => null,
    ],
    Slugify::class => [
        'formater' => null,
    ],
    
];
