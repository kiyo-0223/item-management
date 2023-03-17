<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '管理者１',
            'email' => 'owner1@test.com',
            'password' => bcrypt('password1'),
            'role' => 1,
            'created_at' => now(),
        ]);
        User::create([
            'name' => 'ユーザー１',
            'email' => 'user1@test.com',
            'password' => bcrypt('password1'),
            'role' => 2,
            'created_at' => now(),
        ]);
    }
}
