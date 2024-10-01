<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Job Portal Admin',
            'email' => 'job@admin.com',
            'phone' => '01905256528',
            'role' => 'admin',
            'password' => bcrypt('job2645')
        ]);

    }
}
