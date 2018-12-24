<?php

namespace Core;

trait Relationship
{
    public function hasMany($model, $field, $value)
    {
        return $model::getBy($field, $value)->result;
    }
}