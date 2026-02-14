<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'department' => 'Management',
        ]);

        // Create Manager User
        $manager = User::create([
            'name' => 'John Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'active',
            'department' => 'Operations',
        ]);

        // Create Regular Users
        $user1 = User::create([
            'name' => 'Alice Developer',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'department' => 'Engineering',
        ]);

        $user2 = User::create([
            'name' => 'Bob Designer',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'department' => 'Design',
        ]);

        // Create Projects
        $project1 = Project::create([
            'name' => 'Website Redesign',
            'description' => 'Complete redesign of company website',
            'status' => 'active',
            'owner_id' => $manager->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'budget' => 50000,
            'progress' => 45,
            'color' => '#3b82f6',
        ]);

        $project2 = Project::create([
            'name' => 'Mobile App Development',
            'description' => 'Develop iOS and Android mobile applications',
            'status' => 'active',
            'owner_id' => $admin->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'budget' => 100000,
            'progress' => 20,
            'color' => '#8b5cf6',
        ]);

        // Add team members to task-history
        $project1->members()->attach([$user1->id, $user2->id]);
        $project2->members()->attach([$user1->id]);

        // Create Tasks
        Task::create([
            'title' => 'Design homepage mockup',
            'description' => 'Create high-fidelity mockup for new homepage',
            'status' => 'completed',
            'priority' => 'high',
            'project_id' => $project1->id,
            'assigned_to' => $user2->id,
            'created_by' => $manager->id,
            'due_date' => now()->addDays(7),
            'estimated_hours' => 16,
        ]);

        Task::create([
            'title' => 'Implement responsive navigation',
            'description' => 'Build mobile-friendly navigation menu',
            'status' => 'in_progress',
            'priority' => 'high',
            'project_id' => $project1->id,
            'assigned_to' => $user1->id,
            'created_by' => $manager->id,
            'due_date' => now()->addDays(10),
            'estimated_hours' => 8,
        ]);

        Task::create([
            'title' => 'Set up API endpoints',
            'description' => 'Create RESTful API for mobile app',
            'status' => 'pending',
            'priority' => 'urgent',
            'project_id' => $project2->id,
            'assigned_to' => $user1->id,
            'created_by' => $admin->id,
            'due_date' => now()->addDays(14),
            'estimated_hours' => 24,
        ]);

        Task::create([
            'title' => 'Write user documentation',
            'description' => 'Create comprehensive user guide',
            'status' => 'pending',
            'priority' => 'medium',
            'project_id' => $project1->id,
            'assigned_to' => $user2->id,
            'created_by' => $manager->id,
            'due_date' => now()->addDays(21),
            'estimated_hours' => 12,
        ]);

        echo "Database seeded successfully!\n";
        echo "Admin email: admin@example.com\n";
        echo "Password: password\n";
    }
}
