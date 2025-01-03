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
        Schema::create('booking_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            // $table->string('type');
            $table->string('discount_amount');
            $table->string('rule');
            $table->boolean('invert')
                ->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_discounts');
    }
};
