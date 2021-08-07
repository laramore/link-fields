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

use Illuminate\Support\Str;
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

        return parent::has($model);
    }

    /**
     * Get the value definied by the field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function get($model)
    {
        if (! $this->has($model)) {
            $value = $this->retrieve($model);

            return $this->set($model, $value);
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
            return Str::snake($field->get($model), $this->separator);
        }, $this->basedOn));

        return preg_replace("/[^a-z0-9{$this->separator}]/", '', $value);
    }

    /**
     * Auto retrieve during saving and updating.
     *
     * @return void
     */
    protected function locking()
    {
        parent::locking();

        $this->getMeta()->getModelClass()::saving([$this, 'get']);
        $this->getMeta()->getModelClass()::updating([$this, 'get']);
    }
}
