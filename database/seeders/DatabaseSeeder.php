<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $merchant = User::create([
            'name' => 'Merchant',
            'email' => 'merchant@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'merchant'
        ]);

        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'customer'
        ]);

        $merchant->Merchant()->create([
            'company_name' => 'McDonald',
            'address' => '123 Merchant St',
            'type' => 'Makanan Cepat Saji',
            'contact' => '123-456-7890',
            'description' => 'This is a McDonald',
        ]);
    }
}
