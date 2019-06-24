<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Balance
 * @package App
 */
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
     * get last update in human readable format
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

    /**
     * Gather data for rendering daily profit chart
     * @return array
     */
    public function getLastMonthProfitByDay()
    {
        $records = self::where('created_at', '>', Carbon::now()->subMonth())->orderBy('created_at', 'asc')->get();

        $groupedByDay = $records->groupBy(function ($item) {
            return $item->created_at->format('d-M-y');
        });

        $data = [];
        foreach ($groupedByDay as $date => $day) {
            $data[$date] = (float) number_format($day->max('total_profit') - $day->min('total_profit'), 2);
        }

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'label' => 'Daily earnings',
                    'data' => array_values($data),
                    'fill' => false,
                    'borderColor' => 'rgba(0, 0, 0, 1)',
                ],
            ]
        ];
    }

}
