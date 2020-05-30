<?php
/**
 * Add a based on trait.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Traits\Field;

use Laramore\Contracts\Field\Field;

trait BasedOnFields
{
    /**
     * Fields on which to base on.
     *
     * @var array Field names, fields.
     */
    protected $basedOn;

    /**
     * This field is linked and based on something.
     *
     * @param  string|Field|array $value
     * @return mixed
     */
    public function basedOn($value)
    {
        $this->needsToBeUnlocked();

        $value = (!\is_array($value) || ($value instanceof Field)) ? [$value] : $value;

        foreach ($value as $subValue) {
            if (!\is_string($subValue) && !($subValue instanceof Field)) {
                throw new \LogicException("The field {$this->getName()} requires a basedOn field. Got `$subValue`.");
            }
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
            throw new \LogicException("The field {$this->getName()} requires a basedOn field.");
        } else {
            $this->basedOn = \array_map(function ($value) {
                return ($value instanceof Field) ? $value : $this->getMeta()->getField($value);
            }, $this->basedOn);
        }
    }
}
