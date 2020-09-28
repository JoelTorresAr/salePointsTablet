<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandPaytypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_paytype', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('paytype_id');            
            $table->decimal('payment_with',17,3);
            $table->decimal('change',17,3)->default(0);

            
            $table->foreign('command_id')->references('id')->on('commands')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('paytype_id')->references('id')->on('pay_types')
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
        Schema::dropIfExists('command_paytype');
    }
}
