<?php

/**
 * Make a new model factory
 *
 * @param         $model
 * @param  array  $attributes
 * @param  null   $count
 *
 * @return mixed
 */
function make($model, $attributes = [], $count = null) {
    return factory($model, $count)->make($attributes);
}

/**
 * Create a new model factory.
 *
 * @param         $model
 * @param  array  $attributes
 * @param  null   $count
 *
 * @return mixed
 */
function create($model, $attributes = [], $count = null) {
    return factory($model, $count)->create($attributes);
}