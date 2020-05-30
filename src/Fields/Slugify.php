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
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function has(LaramoreModel $model)
    {
        foreach ($this->basedOn as $field) {
            if ($field->has($model)) {
                return true;
            }
        }

        return $model->hasAttributeValue($this->getName());
    }

    /**
     * Get the value definied by the field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function get(LaramoreModel $model)
    {
        return $this->retrieve($model);
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

    /**
     * Retrieve values from the relation field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function retrieve(LaramoreModel $model)
    {
        if (!$model->hasAttributeValue($name = $this->getName())) {
            $value = \implode($this->separator ?: '-', \array_map(function ($field) use ($model) {
                return $field->getOwner()->getFieldValue($field, $model);
            }, $this->basedOn));

            $this->getOwner()->setFieldValue($this, $model, $value);
        }

        return $model->getAttributeValue($name);
    }
}
