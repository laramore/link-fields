<?php
/**
 * Define a relation field, based on another field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2021
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Contracts\Eloquent\LaramoreModel;

class RelationToOne extends BaseRelation
{
    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        $modelClass = $this->getTargetModel();

        if (\is_null($value) || ($value instanceof $modelClass)) {
            return $value;
        }

        return new $modelClass($value);
    }

    /**
     * Resolve values from the relation field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function resolve($model)
    {
        if ($model instanceof LaramoreModel) {
            return $this->relate($model)->first();
        }

        return $this->getDefault();
    }
}
