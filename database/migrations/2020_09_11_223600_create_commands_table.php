<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_remote_id')->nullable();
            $table->unsignedBigInteger('cash_box_id');
            $table->unsignedBigInteger('command_type_id');
            $table->string('takeaway_name')->nullable();
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('delivery_client_id')->nullable();
            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->unsignedBigInteger('editing_by_id')->nullable();
            $table->string('editing_by_name')->nullable();
            $table->decimal('payment_with',17,2)->default(0);
            $table->string('state',1)->nullable()->default(1);
            $table->string('edit_status')->default('O');
            $table->decimal('subtotal',17,4)->default(0);
            $table->decimal('igv',17,4)->default(0);
            $table->decimal('total',17,4)->default(0);
            $table->string('sale_type',1)->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->string('serie',8)->nullable();
            $table->string('number',8)->nullable();
            $table->integer('print_number')->default(0);
            $table->dateTime('date_time',0)->useCurrent();
            $table->integer('send_sunat')->default(0);
            $table->integer('i_sunat')->default(0);


            $table->foreign('editing_by_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('command_type_id')->references('id')->on('command_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('floor_id')->references('id')->on('floors')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('delivery_client_id')->references('id')->on('delivery_clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('carrier_id')->references('id')->on('carriers')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')
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
        Schema::dropIfExists('commands');
        Schema::enableForeignKeyConstraints();
    }
}
