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
            $table->string('invoice_no');
            $table->foreignId('order_table_id')->constrained('order_tables')->onDelete('cascade');
            $table->integer('discount')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('service_charges');
            $table->integer('net_amount')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('change')->default(0);
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
