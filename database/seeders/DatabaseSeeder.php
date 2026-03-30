<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\StudentProfile;
use App\Models\JobPosting;
use App\Models\NewsEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $password = Hash::make('password');

        // 1. Create Core Users
        $admin = User::firstOrCreate([
            'email' => 'admin@loralai.edu.pk',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
            'is_verified' => true,
        ]);

        $demoStudent = User::firstOrCreate([
            'email' => 'student@example.com',
        ], [
            'name' => 'Demo Student',
            'password' => $password,
            'role' => User::ROLE_STUDENT,
            'is_verified' => true,
        ]);

        StudentProfile::updateOrCreate(
            ['user_id' => $demoStudent->id],
            [
                'enrollment_no' => 'FA20-BCS-001',
                'department' => 'Computer Science',
                'current_semester' => '8th',
                'phone_no' => $faker->phoneNumber,
            ]
        );

        $demoAlumni = User::firstOrCreate([
            'email' => 'alumni@example.com',
        ], [
            'name' => 'Demo Alumni',
            'password' => $password,
            'role' => User::ROLE_ALUMNI,
            'is_verified' => true,
        ]);
        
        AlumniProfile::updateOrCreate(
            ['user_id' => $demoAlumni->id],
            [
                'graduation_year' => '2020',
                'department' => 'Software Engineering',
                'job_title' => 'Senior Developer',
                'company' => 'Tech Corp',
                'location' => 'Islamabad, PK',
                'linkedin_url' => 'https://linkedin.com/in/demoalumni',
                'bio' => 'Experienced software engineer looking to help current students.',
            ]
        );

        // 2. Generate Random Verified Alumni
        $alumniList = [];
        for ($i = 0; $i < 15; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $password,
                'role' => User::ROLE_ALUMNI,
                'is_verified' => true,
            ]);
            
            AlumniProfile::create([
                'user_id' => $user->id,
                'graduation_year' => $faker->randomElement(['2018', '2019', '2020', '2021', '2022', '2023']),
                'department' => $faker->randomElement(['Computer Science', 'Software Engineering', 'IT', 'Business Administration']),
                'job_title' => $faker->jobTitle,
                'company' => $faker->company,
                'location' => $faker->city . ', ' . $faker->country,
                'linkedin_url' => 'https://linkedin.com/in/' . $faker->userName,
                'bio' => $faker->paragraph,
            ]);
            $alumniList[] = $user;
        }

        // 3. Generate Random Job Postings
        $jobTypes = ['full-time', 'part-time', 'internship', 'contract'];
        foreach ($alumniList as $alumnus) {
            if (rand(0, 1)) { // 50% chance they posted a job
                JobPosting::create([
                    'user_id' => $alumnus->id,
                    'title' => $faker->randomElement(['Software Engineer', 'Frontend Developer', 'Marketing Intern', 'Data Analyst', 'Product Manager']),
                    'company' => $alumnus->alumniProfile->company ?? $faker->company,
                    'location' => $faker->randomElement(['Remote', $faker->city . ', ' . $faker->country]),
                    'type' => $faker->randomElement($jobTypes),
                    'description' => implode("\n\n", $faker->paragraphs(2)),
                    'requirements' => implode("\n- ", $faker->sentences(3)),
                    'apply_url' => $faker->url,
                    'is_active' => true,
                    'created_at' => $faker->dateTimeBetween('-1 month', 'now')
                ]);
            }
        }

        // 4. Generate News & Events
        $eventImages = [
            'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
            'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&q=80',
            'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80'
        ];

        for ($i = 0; $i < 6; $i++) {
            $isEvent = rand(0, 1) === 1;
            NewsEvent::create([
                'user_id' => $admin->id,
                'title' => $isEvent ? $faker->catchPhrase . ' Summit' : 'University Update: ' . $faker->sentence(4),
                'content' => implode("\n\n", $faker->paragraphs(3)),
                'image_url' => $faker->randomElement($eventImages),
                'type' => $isEvent ? 'event' : 'news',
                'event_date' => $isEvent ? $faker->dateTimeBetween('now', '+2 months') : null,
                'is_public' => true,
                'created_at' => $faker->dateTimeBetween('-2 months', 'now')
            ]);
        }
    }
}
