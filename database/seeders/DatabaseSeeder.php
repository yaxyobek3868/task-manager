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



        echo "Database seeded successfully!\n";
        echo "Admin email: admin@example.com\n";
        echo "Password: password\n";
    }
}
