<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->string('serie',5);
            $table->string('number',5);
            $table->dateTime('date_time',0);
            $table->decimal('subtotal',17,4);
            $table->decimal('igv',17,4);
            $table->decimal('total',17,4);
            $table->string('state',1);
            $table->unsignedBigInteger('warehouse_id');

            $table->foreign('provider_id')->references('id')->on('providers')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')
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
        Schema::dropIfExists('purchases');
    }
}
