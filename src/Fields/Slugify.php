<?php
/**
 * Define a specific text field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Contracts\{
    Eloquent\LaramoreModel, Field\ExtraField, Field\LinkField, Field\Constraint\UniqueField
};
use Laramore\Fields\Constraint\UniqueConstraintHandler;
use Laramore\Traits\Field\BasedOnFields;

class Slugify extends Body implements ExtraField, LinkField, UniqueField
{
    use BasedOnFields;

    /**
     * Create a Constraint handler for this meta.
     *
     * @return void
     */
    protected function setConstraintHandler()
    {
        $this->constraintHandler = new UniqueConstraintHandler($this);
    }

    /**
     * Return the relation handler for this meta.
     *
     * @return UniqueConstraintHandler
     */
    public function getConstraintHandler(): UniqueConstraintHandler
    {
        return parent::getConstraintHandler();
    }

    /**
     * Indicate if the field has a value.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function has($model)
    {
        foreach ($this->basedOn as $field) {
            if ($field->has($model)) {
                return true;
            }
        }

        return $this->has($model);
    }

    /**
     * Get the value definied by the field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function get($model)
    {
        if (!$this->has($model)) {
            return $this->retrieve($model);
        }

        return parent::get($model);
    }

    /**
     * Retrieve values from the relation field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function retrieve($model)
    {
        $value = \implode($this->separator, \array_map(function ($field) use ($model) {
            return $field->get($model);
        }, $this->basedOn));

        $this->set($model, $value);
    }

    /**
     * Auto retrieve during saving and updating.
     *
     * @return void
     */
    protected function locking()
    {
        parent::locking();

        $this->getMeta()->getModelClass()::saving([$this, 'retrieve']);
        $this->getMeta()->getModelClass()::updating([$this, 'retrieve']);
    }
}
