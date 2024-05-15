<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Machine;
use App\Models\GlobalDescription;
use App\Models\MachineData;
use App\Models\MachineOperation;
use App\Models\User;
use App\Models\Audits;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate regular users
        User::factory(10)->create();

        // Generate an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        Machine::create([
            'machine_name' => 'Machine 1',
            'category' => 'Category 1',
            'line' => 'line1',
        ]);

        Machine::create([
            'machine_name' => 'Machine 2',
            'category' => 'Category 2',
            'line' => 'line1',
        ]);

        MachineData::create([
            'machine_id' => '1',
            'machine_name' => 'Machine 1',
            'year'=>'2024',
            'month'=>'04',
            'week'=>'1',
            'date'=>'2024-04-01 00:00:00',
        ]);

        MachineData::create([
            'machine_id' => '1',
            'machine_name' => 'Machine 2',
            'year'=>'2024',
            'month'=>'04',
            'week'=>'1',
            'date'=>'2024-04-01 00:00:00',
        ]);

        MachineOperation::create([
            'machine_id' => '1',
            'year' => '2024',
            'month' => '04',
            'week' => '1',
            'day' => 'Sunday',
            'code' => 'ABC123',
            'time' => '12:00:00',
            'status' => 'PJL',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);

        MachineOperation::create([
            'machine_id' => '1',
            'year' => '2024',
            'month' => '04',
            'week' => '1',
            'day' => 'Sunday',
            'code' => 'ABC123',
            'time' => '11:00:00',
            'status' => 'PJL',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);

        MachineOperation::create([
            'machine_id' => '1',
            'year' => '2024',
            'month' => '04',
            'week' => '1',
            'day' => 'Monday',
            'code' => 'ABC123',
            'time' => '12:00:00',
            'status' => 'PJL',
            'description' => 'Description 1',
            'is_changed' => false,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => true,
            'approved_by' => 'None',
        ]);

        MachineOperation::create([
            'machine_id' => '1',
            'year' => '2024',
            'month' => '04',
            'week' => '2',
            'day' => 'Sunday',
            'code' => 'ABC123',
            'time' => '11:00:00',
            'status' => 'PJL',
            'description' => 'Description 1',
            'is_changed' => true,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => false,
            'approved_by' => 'None',
        ]);

        MachineOperation::create([
            'machine_id' => '1',
            'year' => '2024',
            'month' => '04',
            'week' => '2',
            'day' => 'Monday',
            'code' => 'ABC123',
            'time' => '12:00:00',
            'status' => 'PJL',
            'description' => 'Description 1',
            'is_changed' => false,
            'changed_by' => 'None',
            'change_date' => now(),
            'is_approved' => true,
            'approved_by' => 'None',
        ]);
    }
}
