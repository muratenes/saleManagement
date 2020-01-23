<?php

use App\User;
use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('type', \App\Role::ROLE_SALES_REPRESENTATIVE);
        })->get();
        foreach ($users as $user) {
            \App\Sale::create([
                'user_id' => $user->id,
                'price' => random_int(10, 100) * 5,
            ]);
        }
    }
}
