<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('balance');
            $table->float('available_funds');
            $table->float('annual_return');
            $table->float('total_profit');
            $table->float('investments');
            $table->float('investments_current');
            $table->float('investments_grace_period');
            $table->float('investments_1_15_late');
            $table->float('investments_16_30_late');
            $table->float('investments_31_60_late');
            $table->float('investments_61_late');
            $table->float('investments_default');
            $table->float('investments_bad_debt');
            $table->float('investments_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
