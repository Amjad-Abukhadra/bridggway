<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Student;
use App\Models\Application;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();

        foreach ($students as $student) {
            $application = Application::where('std_id', $student->id)->first();

            if (!$application) {
                continue;
            }

            for ($week = 0; $week <= 6; $week++) {
                $reportData = [
                    'student_id' => $student->id,
                    'super_id' => $student->super_id,
                    'comp_id' => $application->comp_id,
                    'week_number' => $week,
                    'task' => $week === 0 ? null : "Completed project module for week $week",
                    'tools' => $week === 0 ? null : "VS Code, Git, PHP for week $week",
                    'number_of_hours' => $week === 0 ? null : rand(5, 20),
                ];

                // Only include evaluation fields in week 0 with ENUM value "very_good"
                if ($week === 0) {
                    $reportData = array_merge($reportData, [
                        'performance_level' => 'very_good',
                        'responsibility' => 'very_good',
                        'punctuality' => 'very_good',
                        'accuracy_in_work' => 'very_good',
                        'teamwork' => 'very_good',
                        'adaptability' => 'very_good',
                        'skill_acquisition_speed' => 'very_good',
                        'overall_completion' => 'very_good',
                    ]);
                }

                Report::create($reportData);
            }
        }
    }
}
