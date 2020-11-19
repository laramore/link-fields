<?php

namespace Laramore\Fields;

use Illuminate\Support\Facades\Schema;
use Laramore\Contracts\Eloquent\LaramoreModel;

return [

    /*
    |--------------------------------------------------------------------------
    | Default text fields
    |--------------------------------------------------------------------------
    |
    | This option defines the default text fields.
    |
    */

    'configurations' => [
        Append::class => [
            'type' => 'append',
        ],
        ClassName::class => [
            'type' => 'char',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
        ],
        Counter::class => [
            'type' => 'increment',
            'step' => 1,
            'proxy' => [
                'configurations' => [
                    'increment' => [],
                    'decrement' => [],
                ],
            ],
        ],
        ModelEnum::class => [
            'type' => 'text_enum',
        ],
        ModelName::class => [
            'type' => 'char',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'based_on' => [LaramoreModel::class],
        ],
        Relation::class => [
            'type' => 'relation',
        ],
        ReversedRelation::class => [
            'type' => 'reversed_relation',
        ],
        Slugify::class => [
            'type' => 'slug',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'separator' => '-',
            'based_on' => 'name',
        ],
    ],
    
];
