<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Student;
use App\Models\InternshipOpportunity;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internships = InternshipOpportunity::all();

        foreach (Student::all() as $student) {
            // Random internship for variety
            $internship = $internships->random();

            Application::create([
                'super_id'     => $student->super_id,
                'internship_id' => $internship->id,
                'comp_id'      => $internship->company_id,
                'std_id'       => $student->id,
                'status'       => 0,
            ]);
        }
    }
}
