<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default text types
    |--------------------------------------------------------------------------
    |
    | This option defines the default text types used by fields.
    |
    */

    'configurations' => [
        'first_name' => [
            'native' => 'first_name',
            'default_options' => [
                'visible', 'fillable', 'required', 'title'
            ],
            'migration_name' => 'char',
            'migration_property_keys' => [
                'length:maxLength', 'nullable', 'default',
            ],
        ],
        'last_name' => [
            'native' => 'last_name',
            'default_options' => [
                'visible', 'fillable', 'required', 'uppercase'
            ],
            'migration_name' => 'char',
            'migration_property_keys' => [
                'length:maxLength', 'nullable', 'default',
            ],
        ],
        'url' => [
            'native' => 'url',
            'default_options' => [
                'visible', 'fillable', 'required',
            ],
        ],
        'file' => [
            'native' => 'file',
            'default_options' => [
                'visible', 'fillable', 'required',
            ],
            'factory_name' => 'image',
        ],
    ],

];
