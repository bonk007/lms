<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Database\Factories\EnrollmentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->enroll();
        });

    }

    private function enroll(): void
    {
        $students = User::factory(100)->create();
        $courses = Course::all();

        $students->each(function ($user) use ($courses) {
            Enrollment::factory()
                ->for($user, 'user')
                ->for($courses->random(), 'course')
                ->create();
        });
    }
}
