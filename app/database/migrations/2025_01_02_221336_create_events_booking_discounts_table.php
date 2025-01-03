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
        Schema::create('booking_discount_event', function (Blueprint $table) {
            $table->foreignId('event_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('booking_discount_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['event_id', 'booking_discount_id']);
            $table->index('event_id');
            $table->index('booking_discount_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_booking_discounts');
    }
};
