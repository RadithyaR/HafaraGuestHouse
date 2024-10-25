<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
        });
    }
}
