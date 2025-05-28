<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\InternshipOpportunity;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InternshipOpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        // Define sample internship data
        $titles = [
            'Full Stack Developer Internship',
            'Frontend Developer Internship',
            'Mobile App Developer Internship',
            'Data Analyst Internship',
            'Cloud Engineering Internship',
            'Cybersecurity Internship',
            'Systems Integration Internship',
            'QA Software Tester Internship'
        ];

        $requirements = [
            'Familiar with Laravel, Vue.js, and REST APIs.',
            'Experience with HTML, CSS, JavaScript, and Figma.',
            'Basic knowledge of Flutter or React Native.',
            'Good understanding of Excel, SQL, and Python.',
            'Familiar with AWS, Docker, or Azure.',
            'Understanding of network security and encryption.',
            'Basic scripting and server configuration experience.',
            'Knowledge of testing methodologies and tools.'
        ];

        $descriptions = [
            'Join a fast-paced environment to build web apps.',
            'Work with the frontend team to enhance user experience.',
            'Develop and test mobile apps with guidance.',
            'Help gather insights from datasets and build reports.',
            'Assist with cloud infrastructure setup and deployment.',
            'Participate in security audits and hardening systems.',
            'Support IT team with system automation tasks.',
            'Create test cases and perform regression testing.'
        ];

        $photos = [
            'fullstack.png',
            'frontend.png',
            'mobile.png',
            'data.png',
            'cloud.png',
            'security.png',
            'systems.png',
            'qa.png'
        ];

        $startDate = Carbon::now()->addWeek();
        $endDate = $startDate->copy()->addMonths(2);

        foreach ($companies as $index => $company) {
            InternshipOpportunity::create([
                'company_id'   => $company->id,
                'title'        => $titles[$index % count($titles)],
                'requirements' => $requirements[$index % count($requirements)],
                'description'  => $descriptions[$index % count($descriptions)],
                'photo'        => $photos[$index % count($photos)],
                'start_time'   => $startDate,
                'end_time'     => $endDate,
            ]);
        }
    }
}
