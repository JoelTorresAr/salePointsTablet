<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBoxBinnaclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_box_binnacles', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->decimal('input',17,2);
            $table->decimal('output',17,2);
            $table->decimal('balance',17,2);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cash_box_id');
            $table->unsignedBigInteger('opening_id');
            $table->dateTime('date_time',0)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_box_binnacles');
    }
}
