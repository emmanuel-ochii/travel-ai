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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained()->cascadeOnDelete();
            $table->string('flight_number');
            $table->foreignId('origin_airport_id')->constrained('airports');
            $table->foreignId('destination_airport_id')->constrained('airports');
            $table->dateTime('depart_at');
            $table->dateTime('arrive_at');

            $table->integer('duration_minutes')->unsigned();
            $table->integer('stops')->default(0);
            $table->bigInteger('base_price_cents')->unsigned();
            $table->string('currency', 8)->default('USD');
            $table->timestamps();

            $table->index(['origin_airport_id', 'destination_airport_id', 'depart_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
