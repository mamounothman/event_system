<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (DB::table('booking_discounts')->where('id', '1')->exists()) {
            $this->command->info('Booking discount seeder has already been run.');
            return;
        }

        DB::table('booking_discounts')->insert([
            'description' => '30% discount for the first 10% bookings',
            'discount_amount' => 30,
            'rule' => 0.3,
            'invert' => 0
        ]);

        DB::table('booking_discounts')->insert([
            'description' => '10% discount for the last 10% bookings',
            'discount_amount' => 30,
            'rule' => 0.3,
            'invert' => 1
        ]);
    }
}
