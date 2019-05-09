<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'balance',
        'available_funds',
        'annual_return',
        'total_profit',
        'investments',
        'investments_current',
        'investments_grace_period',
        'investments_1_15_late',
        'investments_16_30_late',
        'investments_31_60_late',
        'investments_61_late',
        'investments_default',
        'investments_bad_debt',
        'investments_total',
    ];

    /**
     * calculate total profit for last day
     * @return string
     */
    public function getProfitFromLastDay()
    {
        $startInterval = Carbon::now()->subDay();
        return $this->calculateProfitWithinInterval($startInterval);
    }

    /**
     * calculate profit for last week
     * @return string
     */
    public function getProfitFromLastWeek() {
        $startInterval = Carbon::now()->subWeek();
        return $this->calculateProfitWithinInterval($startInterval);
    }

    /**
     * calculate profit for last month
     * @return string
     */
    public function getProfitFromLastMonth()
    {
        $startInterval = Carbon::now()->subMonth();
        return $this->calculateProfitWithinInterval($startInterval);
    }

    /**
     * calculate profit for last year
     * @return string
     */
    public function getProfitFromLastYear()
    {
        $startInterval = Carbon::now()->subYear();
        return $this->calculateProfitWithinInterval($startInterval);
    }

    /**
     * get last update in human readable form
     * @return string
     */
    public function getLastUpdateAttribute()
    {
        return $this->created_at->diffForHumans(Carbon::now());
    }

    /**
     * calculate profit for given interval
     * @param  Carbon  $interval
     * @return string
     */
    private function calculateProfitWithinInterval(Carbon $interval) {
        $first = self::where('created_at', '>', $interval)->orderBy('created_at', 'desc')->limit(1)->first();
        $last = self::where('created_at', '>', $interval)->orderBy('created_at', 'asc')->limit(1)->first();

        return number_format($first->total_profit - $last->total_profit, 2);
    }

}
