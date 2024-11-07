<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Instance;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            DummyDataSeeder::class,
        ]);

        Instance::query()->with(['contributors'])
            ->each(function (Instance $instance) {
                User::factory(3)->asContributor()
                    ->hasAttached($instance, ['status' => 1], 'contributors')
                    ->has(Course::factory()->for($instance, 'instance'), 'createdCourses')
                    ->create();
            });
    }
}
