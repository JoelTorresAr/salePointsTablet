<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_box_id');
            $table->unsignedBigInteger('opening_user');
            $table->unsignedBigInteger('closing_user')->nullable();
            $table->decimal('opening_amount');
            $table->dateTime('opening_date_time',0)->useCurrent();
            $table->dateTime('closing_date_time',0)->nullable();
            $table->decimal('previous_closing_amount',17,2);
            $table->decimal('effective_balance',17,2)->nullable();
            $table->decimal('total_income',17,2)->nullable();
            $table->decimal('total_outcome',17,2)->nullable();
            $table->decimal('total_cash_sales',17,2)->nullable();
            $table->decimal('total_cards_sales',17,2)->nullable();
            $table->decimal('total_credits_sales',17,2)->nullable();
            $table->decimal('total_sales',17,2)->nullable();
            $table->decimal('total_voided_sales',17,2)->nullable();
            $table->decimal('retire_amount',17,2)->nullable();
            $table->decimal('amount_left',17,2)->nullable();
            $table->decimal('surplus_missing',17,2)->nullable();
            $table->unsignedBigInteger('opening_arching_id');
            //$table->unsignedBigInteger('retire_arching_id')->nullable();
            $table->unsignedBigInteger('left_arching_id')->nullable();
            $table->string('state',1);

            $table->foreign('cash_box_id')->references('id')->on('cash_boxes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('opening_user')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('closing_user')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('opening_arching_id')->references('id')->on('archings')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('left_arching_id')->references('id')->on('archings')
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
        Schema::dropIfExists('openings');
        Schema::enableForeignKeyConstraints();
    }
}
