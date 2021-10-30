<?php
/**
 * Define a counter field.
 * It servers to auto increment base on one or multiple fields unicity.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Fields;

use Laramore\Contracts\{
    Eloquent\LaramoreModel, Field\IncrementField, Field\ExtraField, Field\LinkField
};
use Laramore\Traits\Field\{
    BasedOnFields, Increments
};

class Counter extends Number implements IncrementField, ExtraField, LinkField
{
    use Increments, BasedOnFields;

    /**
     * Field on which to base on.
     *
     * @var string Class name, interface.
     */
    protected $basedOn;

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
     * Resolve values from the relation field.
     *
     * @param  LaramoreModel $model
     * @return mixed
     */
    public function resolve(LaramoreModel $model)
    {
        if (!$model->hasAttributeValue($name = $this->getName())) {
            $this->increment($model, $this->lastRecordValue($model));
        }

        return $model->getAttributeValue($name);
    }

    /**
     * Found the last record based on the same caracteristics.
     *
     * @param LaramoreModel $model
     * @return LaramoreModel|null
     */
    public function lastRecord(LaramoreModel $model)
    {
        $builder = $model::newQuery();

        foreach ($this->basedOn as $field) {
            $builder = $builder->where($field->getNative(), $field->get($model));
        }

        return $builder->orderBy($this->getNative(), 'desc')->first();
    }

    /**
     * Found the last record value based on the same caracteristics.
     *
     * @param LaramoreModel $model
     * @return LaramoreModel|null
     */
    public function lastRecordValue(LaramoreModel $model)
    {
        $model = $this->lastRecord($model);

        if (\is_null($model)) {
            return $this->getDefault();
        }

        return $this->get($model);
    }
}
