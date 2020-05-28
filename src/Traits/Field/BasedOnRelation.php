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
        $this->checkNeedsToBeUnlocked();

        if (!\is_string($value) && !($value instanceof RelationField)) {
            throw new \LogicException("The field {$this->getName()} requires a basedOn relation field. Got `$value`.");
        }

        $this->basedOn = $value;

        return $this;
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
        } else if (!($this->basedOn instanceof RelationField)) {
            $this->basedOn = $this->getMeta()->get($this->basedOn);
        }
    }
}
