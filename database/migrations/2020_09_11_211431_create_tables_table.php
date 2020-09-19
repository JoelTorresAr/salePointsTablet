<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name',70);
            $table->string('state',1);
            $table->string('joined',1)->default('0');
            $table->string('order_status',1)->nullable();
            $table->unsignedBigInteger('floor_id');

            $table->foreign('floor_id')->references('id')->on('floors')
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
        Schema::dropIfExists('tables');
        Schema::enableForeignKeyConstraints();
    }
}
