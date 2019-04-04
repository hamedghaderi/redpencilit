<?php

namespace App;

class DocumentDelivery
{
    protected $row;

    /**
     * @param $totalWords
     * @param $date
     * @param $limit
     * @return mixed
     */
    public function addDoc($totalWords, $date, $limit)
    {
        $this->row = Delivery::whereDate('deliver_date', $date->toDateString())->first();

        if ($this->row) {
            if ($this->hasExceedLimits($totalWords, $limit, $this->row))
                return $this->addDoc($totalWords, $date->addDays(1), $limit);

            return $this->row;
        }

        return ['deliver_date' => $date] ;
    }

    /**
     * @param $totalWords
     * @param $limit
     * @return bool
     */
    protected function hasExceedLimits($totalWords, $limit): bool
    {
        return $this->row->limit + $limit > 4 || $totalWords + $this->row->total_words >= 20000;
    }
}