<?php
/**
 * Define a relation field, based on another field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Fields;

use Illuminate\Support\Collection;
use Laramore\Contracts\Eloquent\{
    LaramoreModel, LaramoreBuilder
};
use Laramore\Contracts\Field\{
    RelationField, AttributeField, Constraint\Constraint
};
use Laramore\Elements\{
    TypeElement, OperatorElement
};
use Laramore\Traits\Field\{
    ModelRelation, BasedOnRelation
};

class ReversedRelation extends BaseField implements RelationField
{
    use ModelRelation, BasedOnRelation;

    /**
     * Return the type object of the field.
     *
     * @return TypeElement
     */
    public function getType(): TypeElement
    {
        if ($this->isOwned()) {
            return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
        }

        return parent::getType();
    }

    /**
     * Return the native value of this field.
     * Commonly, its name.
     *
     * @return string
     */
    public function getNative(): string
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Indicate if the relation is head on or not.
     * Usefull to know which to use between source and target.
     *
     * @return boolean
     */
    public function isRelationHeadOn(): bool
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Model where the relation is set from.
     *
     * @return string
     */
    public function getSourceModel(): string
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Return the main attribute where to start the relation from.
     *
     * @return AttributeField
     */
    public function getSourceAttribute(): AttributeField
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Model where the relation is set to.
     *
     * @return string
     */
    public function getTargetModel(): string
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Return the main attribute where to start the relation to.
     *
     * @return AttributeField
     */
    public function getTargetAttribute(): AttributeField
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Return the source of the relation.
     *
     * @return Constraint
     */
    public function getSource(): Constraint
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Return the target of the relation.
     *
     * @return Constraint
     */
    public function getTarget(): Constraint
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Dry the value in a simple format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function dry($value)
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Transform the value to correspond to the field desire.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Serialize the value for outputs.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Reverbate the relation into database or other fields.
     * No reverbation here as it is a link field.
     *
     * @param  LaramoreModel $model
     * @param  mixed         $value
     * @return mixed
     */
    public function reverbate(LaramoreModel $model, $value)
    {
        return $value;
    }

    /**
     * Return the relation with this field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function relate(LaramoreModel $model)
    {
        $this->needsToBeOwned();

        $relation = \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());

        if ($this->hasProperty('when')) {
            return (\call_user_func($this->when, $relation, $model) ?? $relation);
        }

        return $relation;
    }

    /**
     * Add a where null condition from this field.
     *
     * @param  LaramoreBuilder $builder
     * @param  mixed           $value
     * @param  string          $boolean
     * @param  boolean         $not
     * @return LaramoreBuilder
     */
    public function whereNull(LaramoreBuilder $builder, $value=null, string $boolean='and', bool $not=false): LaramoreBuilder
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Add a where not null condition from this field.
     *
     * @param  LaramoreBuilder $builder
     * @param  mixed           $value
     * @param  string          $boolean
     * @return LaramoreBuilder
     */
    public function whereNotNull(LaramoreBuilder $builder, $value=null, string $boolean='and'): LaramoreBuilder
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**LaramoreBuilder
     * Add a where in condition from this field.
     *
     * @param  LaramoreBuilder $builder
     * @param  Collection      $value
     * @param  string          $boolean
     * @param  boolean         $notIn
     * @return LaramoreBuilder
     */
    public function whereIn(LaramoreBuilder $builder, Collection $value=null,
                            string $boolean='and', bool $notIn=false): LaramoreBuilder
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Add a where not in condition from this field.
     *
     * @param  LaramoreBuilder $builder
     * @param  Collection      $value
     * @param  string          $boolean
     * @return LaramoreBuilder
     */
    public function whereNotIn(LaramoreBuilder $builder, Collection $value=null, string $boolean='and'): LaramoreBuilder
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }

    /**
     * Add a where condition from this field.
     *
     * @param  LaramoreBuilder $builder
     * @param  OperatorElement $operator
     * @param  mixed           $value
     * @param  string          $boolean
     * @return LaramoreBuilder
     */
    public function where(LaramoreBuilder $builder, OperatorElement $operator,
                          $value=null, string $boolean='and'): LaramoreBuilder
    {
        $this->needsToBeOwned();

        return \call_user_func([$this->basedOn, __FUNCTION__], ...\func_get_args());
    }
}
