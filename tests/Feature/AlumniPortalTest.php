<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\JobPosting;
use App\Models\NewsEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlumniPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_landing_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_user_can_register_as_alumni(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Alumni',
            'email' => 'testalumni@test.com',
            'role' => User::ROLE_ALUMNI,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        
        // Assert user is marked unverified
        $this->assertDatabaseHas('users', [
            'email' => 'testalumni@test.com',
            'role' => 'alumni',
            'is_verified' => false,
        ]);
    }

    public function test_admin_can_verify_pending_alumni(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'is_verified' => true]);
        $alumni = User::factory()->create(['role' => User::ROLE_ALUMNI, 'is_verified' => false]);

        $response = $this->actingAs($admin)->post("/admin/users/{$alumni->id}/verify");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $alumni->id,
            'is_verified' => true,
        ]);
    }

    public function test_unverified_alumni_cannot_post_jobs(): void
    {
        $unverifiedAlumni = User::factory()->create(['role' => User::ROLE_ALUMNI, 'is_verified' => false]);

        $response = $this->actingAs($unverifiedAlumni)->post('/jobs', [
            'title' => 'Software Engineer',
            'company' => 'Tech Corp',
            'type' => 'full-time',
            'description' => 'Test Description',
        ]);

        $response->assertRedirect(route('alumni.pending'));
    }

    public function test_verified_alumni_can_post_jobs(): void
    {
        $verifiedAlumni = User::factory()->create(['role' => User::ROLE_ALUMNI, 'is_verified' => true]);

        $response = $this->actingAs($verifiedAlumni)->post('/jobs', [
            'title' => 'Backend Developer',
            'company' => 'Tech Corp',
            'type' => 'full-time',
            'description' => 'Test Description',
        ]);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('job_postings', [
            'title' => 'Backend Developer',
            'company' => 'Tech Corp',
        ]);
    }

    public function test_student_can_view_alumni_directory(): void
    {
        $student = User::factory()->create(['role' => User::ROLE_STUDENT, 'is_verified' => true]);
        // Setup a verified alumni so there's content
        User::factory()->create(['role' => User::ROLE_ALUMNI, 'is_verified' => true]);

        $response = $this->actingAs($student)->get('/alumni');

        $response->assertStatus(200);
        $response->assertViewIs('alumni.index');
    }

    public function test_only_admin_can_post_news(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'is_verified' => true]);
        
        $response = $this->actingAs($admin)->post('/admin/news', [
            'title' => 'University Convocation 2026',
            'content' => 'Annual convocation details.',
            'type' => 'event',
            'event_date' => '2026-10-10 10:00:00'
        ]);

        $response->assertRedirect('/news');
        $this->assertDatabaseHas('news_events', [
            'title' => 'University Convocation 2026',
        ]);
    }
}
