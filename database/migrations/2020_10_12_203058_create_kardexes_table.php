<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->string('detail');
            $table->string('reason');
            $table->string('document');
            $table->decimal('input_amount',17,2);
            $table->decimal('output_amount',17,2);
            $table->decimal('input_money',17,2);
            $table->decimal('output_money',17,2);
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('kardexes');
    }
}
