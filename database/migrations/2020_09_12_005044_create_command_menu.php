<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('quantity');
            $table->decimal('sub_total',17,2);
            $table->decimal('igv',17,2);
            $table->decimal('total',17,2);
            $table->string('state',1)->default('A');
            $table->integer('original_quantity')->default(0);
            $table->integer('increment')->default(0);
            $table->string('print_status',1)->default(0);

            $table->foreign('command_id')->references('id')->on('commands')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')
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
        Schema::dropIfExists('command_menu');
        Schema::enableForeignKeyConstraints();
    }
}
