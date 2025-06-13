<?php

namespace App\Livewire\Dashboard\AUI\Concerns;

use App\Models\Course;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait WithDistribution
{
    public function getData(Course $course): Collection
    {
        $sessions = DB::table('course_sessions')
            ->select([
                'cl_status',
                'user_id'
            ])
            ->distinct()
            ->where('course_id', $course->getKey())
            ->where('last_activity_at','>', now()->firstOfMonth())
//            ->groupBy('cl_status')
            ->get()->map(function (\stdClass $object) {
                return [
                    'cl_status' => $object->cl_status ?? 'low',
                    'user_id' => $object->user_id
                ];
            })->groupBy('cl_status')
            ->map(fn (Collection $item) => $item->count());

        return collect([
            'total' => $course->getAttribute('enrollments_count'),
            'low' => 0,
            'medium' => 0,
            'high' => 0,
        ])->merge($sessions);
    }
}
