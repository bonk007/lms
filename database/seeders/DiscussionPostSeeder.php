<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(static function () {

            Course::query()->with([
                'enrollments.user'
            ])->each(static function (Course $course) {

              $enrollments = $course->enrollments;

              if ($enrollments->isEmpty()) {
                  return;
              }

                $discussions = Discussion::factory()
                    ->for($course, 'course')
                    ->count(random_int(3, 10))
                    ->sequence(fn() => ['created_by' => $enrollments->random()->getAttribute('user_id')])
                    ->create();

                $discussions->each(function (Discussion $discussion) use ($course, $enrollments) {
                    Post::factory()
                        ->count(random_int(3, 10))
//                        ->for($course, 'course')
                        ->for($discussion, 'discussion')
                        ->sequence(fn() => ['user_id' => $enrollments->random()->getAttribute('user_id')])
                        ->create();
                });

            });

        });
    }
}
