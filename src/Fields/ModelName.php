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


class ModelName extends ClassName
{
    /**
     * Return possible classes.
     *
     * @return array<string>
     */
    public function getValues(): array
    {
        return \array_keys(Meta::all());
    }
}
