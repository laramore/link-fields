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

use Laramore\Contracts\Field\LinkField;

class ClassName extends Char implements LinkField
{
    /**
     * Class or interface on which to base on.
     *
     * @var string Class name, interface.
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
        $this->needsToBeUnlocked();

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
     * Require a basedOn value.
     *
     * @return void
     */
    protected function locked()
    {
        parent::locked();

        if (\is_null($this->basedOn) || \count($this->basedOn) === 0) {
            throw new \LogicException("The field {$this->getName()} requires basedOn class names.");
        }
    }
}
