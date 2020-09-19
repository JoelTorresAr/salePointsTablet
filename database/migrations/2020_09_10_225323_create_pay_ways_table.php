<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_ways', function (Blueprint $table) {
            $table->id();
            $table->string('name',70);
            $table->unsignedBigInteger('pay_type_id')->nullable();

            $table->foreign('pay_type_id')->references('id')->on('pay_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('pay_ways');
        Schema::enableForeignKeyConstraints();
    }
}
