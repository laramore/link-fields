<?php
/**
 * Link field contract.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Contracts\Field;

interface LinkField extends Field
{
    /**
     * This field is linked and based on something.
     * It depends on the field.
     *
     * @param  mixed $value
     * @return mixed
     */
    public function basedOn($value);
}
