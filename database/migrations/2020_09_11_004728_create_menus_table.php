<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_family_id');
            $table->string('printer');
            $table->string('name');
            $table->decimal('sub_total',17,2);
            $table->decimal('igv',17,2);
            $table->decimal('total',17,2);
            $table->string('state',1)->default('A');
            $table->unsignedBigInteger('shop_id');
            $table->integer('orden')->default(5);

            $table->foreign('menu_family_id')->references('id')->on('menu_families')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')
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
        Schema::dropIfExists('menus');
        Schema::enableForeignKeyConstraints();
    }
}
