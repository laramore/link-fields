<?php
/**
 * Add a based on relation trait.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Traits\Field;

use Laramore\Contracts\Field\RelationField;

trait BasedOnRelation
{
    /**
     * Field on which to base on.
     *
     * @var RelationField Field.
     */
    protected $basedOn;

    /**
     * This field is linked and based on something.
     *
     * @param  string|RelationField $value
     * @return mixed
     */
    public function basedOn($value)
    {
        $this->needsToBeUnlocked();

        if (!\is_string($value) && !($value instanceof RelationField)) {
            throw new \LogicException("The field {$this->getName()} requires a basedOn relation field. Got `$value`.");
        }

        $this->basedOn = $value;

        return $this;
    }

    /**
     * Call based on method.
     *
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    public function callBasedOn(string $method, array $args)
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, $method], ...$args);
    }

    /**
     * Require a basedOn value.
     *
     * @return void
     */
    protected function locking()
    {
        parent::locking();

        if (\is_null($this->basedOn)) {
            throw new \LogicException("The field {$this->getName()} requires a basedOn callable.");
        } else if (!($this->basedOn instanceof RelationField)) {
            $this->basedOn = $this->getMeta()->getField($this->basedOn);
        }

        $options = $this->options;
        $this->options = $this->basedOn->getOptions();
        $this->addOptions($options);
    }

    /**
     * Require a basedOn value.
     *
     * @return void
     */
    protected function owned()
    {
        parent::owned();

        if (\is_null($this->basedOn)) {
            throw new \LogicException("The field {$this->getName()} requires a basedOn relation field.");
        }
    }
}
