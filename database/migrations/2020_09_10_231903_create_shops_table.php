<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('name',70);
            $table->string('social_reason')->nullable();
            $table->string('ruc');
            $table->string('telephone');
            $table->string('address');
            $table->string('email');
            $table->string('state',1);

            $table->foreign('business_id')->references('id')->on('businesses')
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
        Schema::dropIfExists('shops');
        Schema::enableForeignKeyConstraints();
    }
}
