<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('roomType_id');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('roomType_id')->references('id')->on('room_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_detail', function (Blueprint $table) {
            // Hapus foreign key dan kolom booking_id
            $table->dropForeign(['booking_id']);
            $table->dropColumn('booking_id');
            
            // Hapus foreign key dan kolom roomTypes_id
            $table->dropForeign(['roomType_id']);
            $table->dropColumn('roomType_id');
        });
    }
};
