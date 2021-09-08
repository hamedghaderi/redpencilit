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
    return (new $model)->factory()->count($count)->make($attributes);
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
    return (new $model)->factory()->count($count)->create($attributes);
}
