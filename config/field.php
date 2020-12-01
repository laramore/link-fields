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
            'options' => [
                'visible', 'fillable', 'required',
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
            'migration_name' => null,
        ],
        ClassName::class => [
            'options' => [
                'visible', 'fillable', 'required',
            ],
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'resize' => [],
                ],
            ],
        ],
        Counter::class => [
            'options' => [
                'visible', 'required',
            ],
            'step' => 1,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'increment' => [],
                    'decrement' => [],
                ],
            ],
        ],
        ModelEnum::class => [
            'options' => [
                'visible', 'fillable', 'required',
            ],
            'elements_proxy' => [
                'class' => \Laramore\Proxies\EnumProxy::class,
                'configurations' => [
                    'is' => [
                        'templates' => [
                            'name' => '-{methodname}-^{elementname}',
                        ],
                        'needs_value' => true,
                    ],
                ],
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'get_elements' => [
                        'templates' => [
                            'name' => 'get-^{identifier}Elements',
                        ],
                    ],
                    'get_elements_value' => [
                        'templates' => [
                            'name' => 'get+^{identifier}',
                        ],
                    ],
                    'is' => [
                        'needs_value' => true,
                    ],
                    'is_not' => [
                        'needs_value' => true,
                    ],
                ],
            ],
            'migration_name' => 'char',
            'migration_property_keys' => [
                'length:maxLength', 'nullable', 'default',
            ],
            'factory_name' => 'enum',
        ],
        ModelName::class => [
            'options' => [
                'visible', 'fillable', 'required',
            ],
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'based_on' => [LaramoreModel::class],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'resize' => [],
                ],
            ],
        ],
        Relation::class => [
            'options' => [
                'visible', 'fillable',
            ],
        ],
        ReversedRelation::class => [
            'options' => [
                'visible', 'fillable',
            ],
        ],
        Slugify::class => [
            'options' => [
                'visible', 'fillable', 'required', 'slug',
            ],
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'separator' => '-',
            'based_on' => 'name',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'resize' => [],
                ],
            ],
            'migration_name' => 'char',
            'migration_property_keys' => [
                'length:maxLength', 'nullable', 'default',
            ],
        ],
    ],
    
];
