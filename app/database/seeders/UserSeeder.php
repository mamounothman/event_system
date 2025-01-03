<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (DB::table('users')->where('id', '1')->exists()) {
            $this->command->info('user seeder has already been run.');
            return;
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@local.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
