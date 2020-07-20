<?php
/**
 * Define a model enum field manager used by Laramore.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2020
 * @license MIT
 */

namespace Laramore\Elements;

class ModelEnumManager extends EnumManager
{
    protected $elementClass = ModelEnumElement::class;
}
