<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',12)->unique();
            $table->string('social_reason',200)->unique();
            $table->string('telephone',15);
            $table->string('email');
            $table->string('fiscal_address');
            $table->string('commercial_address');
            $table->string('state');
            $table->unsignedBigInteger('business_id')->nullable();
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
        Schema::dropIfExists('businesses');
        Schema::enableForeignKeyConstraints();
    }
}
