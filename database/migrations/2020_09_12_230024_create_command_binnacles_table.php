<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandBinnaclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_binnacles', function (Blueprint $table) {
            $table->id();
            $table->string('operation',1);
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('date_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_binnacles');
    }
}
