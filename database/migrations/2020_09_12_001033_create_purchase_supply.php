<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseSupply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_supply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('supply_id');
            $table->decimal('quantity',17,2);
            $table->decimal('weight',17,3);
            $table->decimal('price',17,2);
            $table->decimal('sub_total',17,2);

            $table->foreign('purchase_id')->references('id')->on('purchases')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('supply_id')->references('id')->on('supplies')
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
        Schema::dropIfExists('purchase_supply');
        Schema::enableForeignKeyConstraints();
    }
}
