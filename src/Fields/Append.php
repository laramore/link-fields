<?php
/**
 * Define an append field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Contracts\Field\{
    LinkField, ExtraField
};

class Append extends BaseField implements LinkField, ExtraField
{
    /**
     * Class or interface on which to base on.
     *
     * @var string Class name, interface.
     */
    protected $basedOn;

    /**
     * This field is linked and based on something.
     * The value is retrieved based on the callaback.
     *
     * @param  callaback|\Closure $value
     * @return mixed
     */
    public function basedOn($value)
    {
        $this->needsToBeUnlocked();

        if (!\is_callable($value)) {
            throw new \LogicException("The field {$this->getName()} requires a callable. Got `$value`.");
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

        if (\is_null($this->basedOn)) {
            throw new \LogicException("The field {$this->getName()} requires a basedOn callable.");
        }
    }
}
