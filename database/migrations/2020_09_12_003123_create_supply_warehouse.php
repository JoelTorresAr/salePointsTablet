<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_warehouse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('supply_id');
            $table->decimal('current_quantity',17,2);
            $table->string('state',1)->default('A');

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
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
        Schema::dropIfExists('supply_warehouse');
        Schema::enableForeignKeyConstraints();
    }
}
