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
            $table->id();
            $table->foreignId('event_id');
            // foreignId
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->integer('booking_discount_id');
            // foreignId
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            $table->index(['event_id', 'booking_discount_id']);
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
