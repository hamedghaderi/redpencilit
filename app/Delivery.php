<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $row = null;

    protected $guarded = [];

    public function scopeAddDoc($query, $totalWords, $date, $limit)
    {
       $this->row = $query->where('deliver_date', $date)->first();

       if ($this->row) {
           if ($this->hasExceedLimits($totalWords, $limit, $this->row))
               return $this->addDoc($totalWords, $date->addDays(1), $limit);

           return $query->update([
               'limit' => $this->row->limit + $limit,
               'total_words' => $this->row->total_words + $totalWords
           ]);
       }

       return $query->create([
           'deliver_date' => $date,
           'limit' => $limit,
           'total_words' => $totalWords
       ]);
    }

    /**
     * @param $totalWords
     * @param $limit
     * @param $row
     * @return bool
     */
    protected function hasExceedLimits($totalWords, $limit): bool
    {
        return $this->row->limit + $limit > 4 || $totalWords + $this->row->total_words >= 20000;
    }
}
