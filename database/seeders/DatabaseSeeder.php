<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Gregou',
            'email' => 'test@test.com',
        ]);

        $users = \App\Models\User::factory(300)->create();

        $users = \App\Models\User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Employer::factory()->create([
                'user_id' => $users->pop()->id,
            ]);
        }

        $employers = \App\Models\Employer::all();

        for ($i = 0; $i < 33; $i++) {
            \App\Models\Job::factory()->junior()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }
        for ($i = 0; $i < 33; $i++) {
            \App\Models\Job::factory()->intermediate()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }
        for ($i = 0; $i < 33; $i++) {
            \App\Models\Job::factory()->senior()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }

        foreach($users as $user) {
            $jobs = \App\Models\Job::inRandomOrder()->take(rand(0, 4))->get();

            foreach($jobs as $job) {
                \App\Models\JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id,
                ]);
            }
        }
        
    }
}