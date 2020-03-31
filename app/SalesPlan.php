<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesPlan extends Model
{
    protected $guarded = [];

    public function getMonth()
    {
        $dateObj = \DateTime::createFromFormat('!m', $this->month);
        $monthName = $dateObj->format('F');

        return $monthName;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function getFact()
    {
        return $this->fact;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonthNum()
    {
        return $this->month;
    }

    public function getQuarter()
    {
        $quarter = [
            1 => [1, 2, 3],
            2 => [4, 5, 6],
            3 => [7, 8, 9],
            4 => [10, 11, 12],
        ];

        foreach ($quarter as $key => $item) {
            if (in_array($this->month, $item) !== false) {
                return $key;
            }
        }
        return 0;

    }

    public function getPercent()
    {
        $percent = ceil(($this->fact / $this->plan) * 100);

        return $percent;//intval($percent > 100 ? 100 : $percent);
    }
}
