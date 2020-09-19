<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSupply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_supply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_id');
            $table->unsignedBigInteger('menu_id');
            $table->decimal('quantity',17,2);

            $table->foreign('menu_id')->references('id')->on('menus')
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
        Schema::dropIfExists('menu_supply');
        Schema::enableForeignKeyConstraints();
    }
}
