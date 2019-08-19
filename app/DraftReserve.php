<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DraftReserve extends Model
{

    /**
     * Return available date for delivering project.
     *
     * @param $query
     * @param $count
     *
     * @return mixed
     */
    public function availableDate($count = 0)
    {
        $maxSize = (int) Setting::first()->upload_articles_per_day;

        $date = $this->whereRaw("available + ${count} < $maxSize")->get();

        if (!$date->count()) {
            return Carbon::now()->addDays(10);
        }
    }
}
