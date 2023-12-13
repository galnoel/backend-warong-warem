<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder


{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'managers',
            'email' => 'manager@warongwarem.com',
            'password' => bcrypt('12345678'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'waiters',
            'email' => 'waiter@warongwarem.com',
            'password' => bcrypt('87654321'),
            'role' => 'waiter',
        ]);
    }
}
