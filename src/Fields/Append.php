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

    /**
     * Cast user value into field format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        return $value;
    }

    /**
     * Serialize the value for output.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * Indicate if the field has a value.
     *
     * @param  LaramoreModel|array|\Illuminate\Contracts\Support\\ArrayAccess $model
     * @return mixed
     */
    public function has($model)
    {
        return $model->hasExtra($this->getName());
    }

    /**
     * Get the value definied by the field.
     *
     * @param  LaramoreModel|array|\Illuminate\Contracts\Support\\ArrayAccess $model
     * @return mixed
     */
    public function get($model)
    {
        return $model->getExtra($this->getName());
    }

    /**
     * Set the value for the field.
     *
     * @param  LaramoreModel|array|\Illuminate\Contracts\Support\\ArrayAccess $model
     * @param  mixed                                                          $value
     * @return mixed
     */
    public function set($model, $value)
    {
        throw new \LogicException('Cannot set appended value');
    }

    /**
     * Reset the value for the field.
     *
     * @param  LaramoreModel|array|\Illuminate\Contracts\Support\\ArrayAccess $model
     * @return mixed
     */
    public function reset($model)
    {
        return $model->resetExtra($this->getName());
    }

    /**
     * Retrieve values from the relation field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function retrieve($model)
    {
        return \call_user_func($this->basedOn, $model);
    }

    // /**
    //  * Add a where null condition from this field.
    //  *
    //  * @param  LaramoreBuilder $builder
    //  * @param  string          $boolean
    //  * @param  boolean         $not
    //  * @return LaramoreBuilder
    //  */
    // public function whereNull(LaramoreBuilder $builder, string $boolean='and', bool $not=false): LaramoreBuilder;

    // /**
    //  * Add a where not null condition from this field.
    //  *
    //  * @param  LaramoreBuilder $builder
    //  * @param  string          $boolean
    //  * @return LaramoreBuilder
    //  */
    // public function whereNotNull(LaramoreBuilder $builder, string $boolean='and'): LaramoreBuilder;

    // /**
    //  * Add a where in condition from this field.
    //  *
    //  * @param  LaramoreBuilder $builder
    //  * @param  Collection      $value
    //  * @param  string          $boolean
    //  * @param  boolean         $notIn
    //  * @return LaramoreBuilder
    //  */
    // public function whereIn(LaramoreBuilder $builder, Collection $value=null,
    //                         string $boolean='and', bool $notIn=false): LaramoreBuilder;

    // /**
    //  * Add a where not in condition from this field.
    //  *
    //  * @param  LaramoreBuilder $builder
    //  * @param  Collection      $value
    //  * @param  string          $boolean
    //  * @return LaramoreBuilder
    //  */
    // public function whereNotIn(LaramoreBuilder $builder,
    //                            Collection $value=null, string $boolean='and'): LaramoreBuilder;

    // /**
    //  * Add a where condition from this field.
    //  *
    //  * @param  LaramoreBuilder $builder
    //  * @param  OperatorElement $operator
    //  * @param  mixed           $value
    //  * @param  string          $boolean
    //  * @return LaramoreBuilder
    //  */
    // public function where(LaramoreBuilder $builder, OperatorElement $operator,
    //                       $value=null, string $boolean='and'): LaramoreBuilder;
}
