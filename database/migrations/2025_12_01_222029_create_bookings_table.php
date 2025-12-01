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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fare_id')->constrained()->cascadeOnDelete();
            $table->integer('passengers')->unsigned()->default(1);
            $table->bigInteger('total_price_cents')->unsigned();
            $table->string('currency', 8)->default('USD');
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->string('booking_reference')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
