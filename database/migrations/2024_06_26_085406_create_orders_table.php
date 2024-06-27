<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no');
            $table->foreignId('order_table_id')->constrained('order_tables')->onDelete('cascade');
            $table->integer('discount');
            $table->integer('amount');
            $table->integer('service_charges');
            $table->integer('net_amount');
            $table->integer('paid');
            $table->integer('change');
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
