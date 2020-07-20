<?php
/**
 * Define a specific model enum field element.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Elements;

use Laramore\Contracts\Eloquent\LaramoreModel;

class ModelEnumElement extends EnumElement
{
    /**
     * Create an enum with a specific name.
     *
     * @param string $class
     */
    public function __construct(string $class)
    {
        if (!\is_subclass_of($class, LaramoreModel::class)) {
            throw new \LogicException("A model enum only works with Laramore models. `$class` given");
        }
         $meta = $class::getMeta();

        parent::__construct($class, $meta->getModelClassName(), $meta->getDescription());

        $this->set('class', $class);
    }

    public function getMeta()
    {
        return $this->get('class')::getMeta();
    }
}
