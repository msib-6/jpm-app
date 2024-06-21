<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Machine;
use App\Models\MachineData;
use App\Models\MachineOperation;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager'),
            'role' => 'Manager',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'darkzov16@gmail.com',
            'password' => Hash::make('Test'),
            'role' => 'Line1',
            'email_role' => ['Line1'],
        ]);

    }
}
