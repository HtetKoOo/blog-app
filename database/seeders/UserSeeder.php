<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Mg Mg',
            'email'=>'mgmg@a.com',
            'password'=>Hash::make('mgmg')
        ]);
        Admin::create([
            'name'=>'Admin',
            'email'=>'admin@a.com',
            'password'=>Hash::make('admin')
        ]);
    }
}
