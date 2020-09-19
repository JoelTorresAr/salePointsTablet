<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('warehouse_family_id')->constrained();
            $table->unsignedBigInteger('unity_id');
            $table->decimal('production_unity',17,4);
            $table->decimal('factor',17,4);
            $table->decimal('auto_conversion',17,4);
            $table->text('description');
            $table->string('state',1);
            
            $table->foreign('unity_id')->references('id')->on('unities')
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
        Schema::dropIfExists('supplies');
        Schema::enableForeignKeyConstraints();
    }
}
