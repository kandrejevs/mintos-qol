<?php

namespace App\Http\Controllers;

use App\Balance;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class DataController
 * @package App\Http\Controllers
 */
class DataController extends Controller
{
    /**
     * Main controller that returns data for pwa app
     */
    public function index()
    {
        $latestBalance = Balance::latest()->first();
        $balanceInstance = new Balance;

        $data = [
            'latest' => $latestBalance,
            'total_profits' => [
                'last_day' => $balanceInstance->getProfitFromLastDay(),
                'last_week' => $balanceInstance->getProfitFromLastWeek(),
                'last_month' => $balanceInstance->getProfitFromLastMonth(),
                'last_year' => $balanceInstance->getProfitFromLastYear(),
            ],
            'daily_profits' => $balanceInstance->getLastMonthProfitByDay(),
            'last_update' => $latestBalance->last_update,
        ];

        return $data;
    }
}
