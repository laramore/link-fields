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
        'formater' => 'enum',
    ],
    Counter::class => [
        'formater' => 'randomNumber',
    ],
    ModelEnum::class => [
        'formater' => 'enum',
    ],
    ModelName::class => [
        'formater' => 'enum',
    ],
    Relation::class => null,
    ReversedRelation::class => null,
    Slugify::class => null,
    
];
