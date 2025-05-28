<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Tech Solutions Inc.',
                'location' => 'Amman, Jordan',
                'type' => 'Information Technology',
                'contact_info' => 'contact@techsolutions.com | +962 6 123 4567',
                'description' => 'Leading software development company specializing in web and mobile applications, cloud solutions, and digital transformation.',
                'email' => 'tech@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'tech-solutions.png',
            ],
            [
                'name' => 'Digital Innovation Labs',
                'location' => 'Irbid, Jordan',
                'type' => 'Software Development',
                'contact_info' => 'info@digitallabs.com | +962 2 765 4321',
                'description' => 'Innovation-driven software company focused on creating cutting-edge solutions for businesses and startups.',
                'email' => 'digital@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'digital-labs.png',
            ],
            [
                'name' => 'Jordan Web Services',
                'location' => 'Zarqa, Jordan',
                'type' => 'Web Development',
                'contact_info' => 'contact@jordanweb.com | +962 5 321 7654',
                'description' => 'Full-service web development agency providing custom websites, e-commerce solutions, and digital marketing services.',
                'email' => 'jordan@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'jordan-web.png',
            ],
            [
                'name' => 'Smart Systems Co.',
                'location' => 'Aqaba, Jordan',
                'type' => 'Systems Integration',
                'contact_info' => 'info@smartsystems.com | +962 3 456 7890',
                'description' => 'Systems integration company specializing in enterprise solutions, networking, and IT infrastructure.',
                'email' => 'smart@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'smart-systems.png',
            ],
            [
                'name' => 'Mobile Solutions JO',
                'location' => 'Amman, Jordan',
                'type' => 'Mobile Development',
                'contact_info' => 'contact@mobilejo.com | +962 6 987 6543',
                'description' => 'Mobile app development company creating innovative iOS and Android applications for businesses.',
                'email' => 'mobile@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'mobile-solutions.png',
            ],
            [
                'name' => 'Data Analytics Pro',
                'location' => 'Irbid, Jordan',
                'type' => 'Data Analytics',
                'contact_info' => 'info@dataanalytics.com | +962 2 345 6789',
                'description' => 'Data analytics company providing business intelligence, data visualization, and predictive analytics services.',
                'email' => 'data@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'data-analytics.png',
            ],
            [
                'name' => 'Cloud Tech Arabia',
                'location' => 'Amman, Jordan',
                'type' => 'Cloud Services',
                'contact_info' => 'support@cloudtech.com | +962 6 234 5678',
                'description' => 'Cloud solutions provider offering hosting, infrastructure, and cloud migration services.',
                'email' => 'cloud@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'cloud-tech.png',
            ],
            [
                'name' => 'Security Plus JO',
                'location' => 'Zarqa, Jordan',
                'type' => 'Cybersecurity',
                'contact_info' => 'security@securityplus.com | +962 5 876 5432',
                'description' => 'Cybersecurity company providing security audits, penetration testing, and security consulting services.',
                'email' => 'security@example.com',
                'password' => Hash::make('password123'),
                'status' => 1,
                'profile_image' => 'security-plus.png',
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
