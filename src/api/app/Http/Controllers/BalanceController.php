<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class BalanceController
 * @package App\Http\Controllers
 */
class BalanceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $balance = new Balance();
        $balance->fill($request->all());
        $balance->save();
    }
}
