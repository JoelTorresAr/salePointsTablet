<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_shop', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('shop_id');
            $table->string('serie',6);
            $table->string('correlative',6);
            $table->string('state',1);

            $table->foreign('invoice_id')->references('id')->on('invoices')
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
        Schema::dropIfExists('invoice_shop');
        Schema::enableForeignKeyConstraints();
    }
}
