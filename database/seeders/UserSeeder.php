<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'user_name' => 'admin',
            'image' => 'https://i.pinimg.com/originals/0e/6a/6a/0e6a6a4b6b5b6b6b6b6b6b6b6b6b6b6b.jpg',
            'is_admin' => true,
            'role' => 1,
            'sum_comment' => 0,
            'sum_list_music' => 0,
            'sum_upload' => 0,
            'password' => bcrypt('123456'),
        ]);
    }
}
