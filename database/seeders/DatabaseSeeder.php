<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@test.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $company = User::create([
            'name'     => 'Tech Company',
            'email'    => 'company@test.com',
            'password' => Hash::make('password'),
            'role'     => 'company',
        ]);

        $applicant = User::create([
            'name'     => 'Juan dela Cruz',
            'email'    => 'juan@test.com',
            'password' => Hash::make('password'),
            'role'     => 'applicant',
        ]);

        Job::create([
            'user_id'      => $company->id,
            'title'        => 'Laravel Developer',
            'company_name' => 'Tech Company',
            'location'     => 'Manila',
            'description'  => 'We need a skilled Laravel developer.',
            'salary'       => 50000,
            'status'       => 'open',
        ]);

        Job::create([
            'user_id'      => $company->id,
            'title'        => 'Vue.js Developer',
            'company_name' => 'Tech Company',
            'location'     => 'Remote',
            'description'  => 'We need a Vue.js frontend developer.',
            'salary'       => 45000,
            'status'       => 'open',
        ]);
    }
}
