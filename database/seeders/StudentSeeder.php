<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            ['Ali Nasser', 'ali.nasser@example.com'],
            ['Sara Majali', 'sara.majali@example.com'],
            ['Omar Khalid', 'omar.khalid@example.com'],
            ['Leen Zayed', 'leen.zayed@example.com'],
            ['Hani Salameh', 'hani.salameh@example.com'],
            ['Dana Abu Rumman', 'dana.rumman@example.com'],
        ];

        $supervisors = Supervisor::all();
        $nameIndex = 0;

        foreach ($supervisors as $supervisor) {
            for ($i = 0; $i < 2; $i++) {
                if ($nameIndex >= count($names)) {
                    break;
                }

                Student::create([
                    'super_id'      => $supervisor->id,
                    'college_id'    => 1,
                    'st_department' => $supervisor->super_department,
                    'full_name'     => $names[$nameIndex][0],
                    'email'         => $names[$nameIndex][1],
                    'password'      => Hash::make('password123'),
                    'status'        => 1,
                    'gpa'           => rand(50, 100),
                    'resume'        => rand(0, 100),
                ]);

                $nameIndex++;
            }
        }
    }
}
