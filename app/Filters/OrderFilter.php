<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderFilter
{
    private $request;

    protected $filters = ['status', 'delivery_date'];

    protected $builder;

    /**
     * OrderFilter constructor.
     *
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Filter an order based on given filters
     *
     * @param $builder
     *
     * @return mixed
     */
    public function filterBy($builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $filter => $value) {
            if (method_exists(static::class, $filter)) {
                $this->{$filter}($value);
            }
        }

        return $this->builder;
    }

    /**
     * Filter an order based on status
     *
     * @param $value
     */
    public function status($value)
    {
        if (! array_key_exists($value, config('orders-status'))) {
            return;
        }

        $this->builder->where('status', config('orders-status')[$value]);
    }

    /**
     * Filter an order based on how much remains until delivery date
     *
     * @param $value
     */
    public function delivery_date($value)
    {
        if (! $value || ! is_int((int) $value)) {
            return;
        }

        $this->builder->whereDate('delivery_date', '<=', Carbon::now()->addDays($value));
    }
}
