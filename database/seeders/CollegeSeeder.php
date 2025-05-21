<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\College;
use Illuminate\Support\Facades\Hash;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = [
            [
                'college_name' => 'College of Engineering',
                'uni_name' => 'University of Technology',
                'email' => 'engineering@uot.edu',
                'password' => Hash::make('password123'),
                'status' => 1,
            ],
            [
                'college_name' => 'College of Business',
                'uni_name' => 'University of Technology',
                'email' => 'business@uot.edu',
                'password' => Hash::make('password123'),
                'status' => 1,
            ],
            [
                'college_name' => 'College of Arts and Sciences',
                'uni_name' => 'State University',
                'email' => 'arts@stateuni.edu',
                'password' => Hash::make('password123'),
                'status' => 1,
            ],
            [
                'college_name' => 'College of Medicine',
                'uni_name' => 'State University',
                'email' => 'medicine@stateuni.edu',
                'password' => Hash::make('password123'),
                'status' => 1,
            ],
            [
                'college_name' => 'College of Education',
                'uni_name' => 'National University',
                'email' => 'education@national.edu',
                'password' => Hash::make('password123'),
                'status' => 1,
            ],
        ];

        foreach ($colleges as $college) {
            College::create($college);
        }
    }
} 