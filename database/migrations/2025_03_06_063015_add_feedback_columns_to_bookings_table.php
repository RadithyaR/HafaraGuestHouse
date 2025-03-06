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
        Schema::table('bookings', function (Blueprint $table) {
                $table->integer('rating')->nullable()->after('status'); // Kolom rating (1-5)
                $table->text('feedback_message')->nullable()->after('rating'); // Kolom pesan feedback

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('rating');
        $table->dropColumn('feedback_message');
        });
    }
};
