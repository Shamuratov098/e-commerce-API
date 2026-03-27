<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Order::factory()->count(fake()->numberBetween(1, 2))->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
