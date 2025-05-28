<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Hash;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supervisors = [
            [
                'full_name' => 'Dr. Ahmad Al-Khatib',
                'email' => 'ahmad.khatib@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'college_id' => 1,
                'super_department' => 'CS', // Computer Science
            ],
            [
                'full_name' => 'Eng. Lina Hassan',
                'email' => 'lina.hassan@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'college_id' => 1,
                'super_department' => 'CIS', // Computer Information Systems
            ],
            [
                'full_name' => 'Prof. Tareq Younis',
                'email' => 'tareq.younis@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'college_id' => 1,
                'super_department' => 'BIT', // Business Information Technology
            ],
        ];

        foreach ($supervisors as $sup) {
            Supervisor::create($sup);
        }
    }
}
