<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInUsedAndRoomIdColumnsToOrderTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_tables', function (Blueprint $table) {
            $table->boolean('in_used')->default(false)->after('active');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade')->after('in_used');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_tables', function (Blueprint $table) {
            //
        });
    }
}
