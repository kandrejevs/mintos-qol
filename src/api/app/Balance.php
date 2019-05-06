<?php

namespace App;

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
}
