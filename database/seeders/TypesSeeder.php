<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => '家電',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '日用品',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '雑貨',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '食品',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '化粧品',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '衣類',
            'created_at' => now(),
        ]);
        Type::create([
            'name' => '玩具',
            'created_at' => now(),
        ]);
    }
}
