<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchingCoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arching_coin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arching_id')->constrained();
            $table->foreignId('coin_id')->constrained();
            $table->decimal('value',17,2);
            $table->decimal('quantity',17,2);
            $table->decimal('total',17,2);
            $table->dateTime('date_time',0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('arching_coin');
        Schema::enableForeignKeyConstraints();
    }
}
