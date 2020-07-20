<?php

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
        'append' => [
            'type' => 'append',
        ],
        'class_name' => [
            'type' => 'char',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
        ],
        'counter' => [
            'type' => 'increment',
            'step' => 1,
            'proxy' => [
                'configurations' => [
                    'increment' => [],
                    'decrement' => [],
                ],
            ],
        ],
        'model_enum' => [
            'type' => 'text_enum',
        ],
        'model_name' => [
            'type' => 'char',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'based_on' => [LaramoreModel::class],
        ],
        'relation' => [
            'type' => 'relation',
        ],
        'reversed_relation' => [
            'type' => 'reversed_relation',
        ],
        'slugify' => [
            'type' => 'slug',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'separator' => '-',
            'based_on' => 'name',
        ],
    ],
    
];
