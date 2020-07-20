<?php
/**
 * Define a specific model name field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Facades\Meta;
use Laramore\Elements\ModelEnumManager;

class ModelEnum extends TextEnum
{
    /**
     * Enum manager class.
     *
     * @var string
     */
    protected $enumManagerClass = ModelEnumManager::class;

    /**
     * Check all properties and options before locking the field.
     *
     * @return void
     */
    protected function checkOptions()
    {
        if (!$this->hasProperty('elements') || $this->elements->count() === 0) {
            $this->elements(\array_keys(Meta::all()));
        }

        parent::checkOptions();
    }
}
