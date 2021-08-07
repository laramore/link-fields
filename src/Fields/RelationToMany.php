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

use Illuminate\Support\Collection;
use Laramore\Contracts\Eloquent\LaramoreModel;

class RelationToMany extends BaseRelation
{

    /**
     * Cast the value in the correct format.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function cast($value)
    {
        if ($value instanceof Collection) {
            return $value;
        }

        if (\is_null($value) || \is_array($value)) {
            return collect($value);
        }

        return collect($this->castModel($value));
    }

    /**
     * Cast the value to be used as a correct model.
     *
     * @param  mixed $value
     * @return LaramoreModel
     */
    public function castModel($value)
    {
        $modelClass = $this->getTargetModel();

        if ($value instanceof $modelClass) {
            return $value;
        }

        return new $modelClass($value);
    }

    /**
     * Retrieve values from the relation field.
     *
     * @param LaramoreModel|array|\ArrayAccess $model
     * @return mixed
     */
    public function retrieve($model)
    {
        if ($model instanceof LaramoreModel) {
            return $this->relate($model)->get();
        }

        return $this->getDefault();
    }
}
