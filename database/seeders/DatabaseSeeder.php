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
        // Generate users

        User::factory(50)->create();
        Machine::factory(100)->create();

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

        Machine::create([
            'machine_name' => 'Machine 1',
            'category' => 'Category 1',
            'line' => ['Line1', 'Line 4', 'Line8a'],
        ]);

        Machine::create([
            'machine_name' => 'Machine 2',
            'category' => 'Category 2',
            'line' => ['Line1', 'Line2'],
        ]);

        MachineData::create([
            'machine_id' => 1,
            'machine_name' => 'Machine 1',
            'year' => '2024',
            'month' => '4',
            'week' => '1',
            'date' => '2024-04-01 00:00:00',
        ]);

        MachineData::create([
            'machine_id' => 2,
            'machine_name' => 'Machine 2',
            'year' => '2024',
            'month' => '4',
            'week' => '1',
            'date' => '2024-04-01 00:00:00',
        ]);

        MachineOperation::create([
            'machine_id' => 1,
            'year' => '2024',
            'month' => '4',
            'week' => '1',
            'day' => '7',
            'code' => 'ABC123',
            'time' => '08:00',
            'status' => 'PJL',
            'notes' => 'Notes 1',
            'current_line' => 'Line1',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);
        
        MachineOperation::create([
            'machine_id' => 1,
            'year' => '2024',
            'month' => '4',
            'week' => '1',
            'day' => '1',
            'code' => 'ABC123',
            'time' => '09:00',
            'status' => 'PJL',
            'notes' => 'Notes 1',
            'current_line' => 'Line1',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);

        MachineOperation::create([
            'machine_id' => 1,
            'year' => '2024',
            'month' => '4',
            'week' => '1',
            'day' => '2',
            'code' => 'ABC123',
            'time' => '10:00',
            'status' => 'PJL',
            'notes' => 'Notes 1',
            'current_line' => 'Line1',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);
    }
}
