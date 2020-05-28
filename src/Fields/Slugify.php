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
    Eloquent\LaramoreModel, Field\ExtraField, Field\LinkField
};

class Slugify extends Body implements ExtraField, LinkField
{
    /**
     * Field to base on.
     *
     * @var Char.
     */
    protected $basedOn;

    /**
     * This field is linked and based on something.
     * Define classes or interfaces the class needs to based on.
     *
     * @param  string|array $value
     * @return mixed
     */
    public function basedOn($value)
    {
        $this->checkNeedsToBeUnlocked();

        $value = \is_string($value) ? [$value] : $value;

        foreach ($value as $class) {
            if (!\class_exists($class)) {
                throw new \LogicException("The field {$this->getName()} requires class names. Got `$class`.");
            }
        }

        $this->basedOn = $value;

        return $this;
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

        return false;
    }

    /**
     * Get the value definied by the field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function get(LaramoreModel $model)
    {
        $this->retrieve($model);
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
            $this->set(
                $model, $this->basedOn->get($model)
            );
        }

        return $model->getAttributeValue($name);
    }
}
