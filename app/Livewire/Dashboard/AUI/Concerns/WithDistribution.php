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
                DB::raw('count(1) as total')
            ])
            ->where('course_id', $course->getKey())
            ->groupBy('cl_status')
            ->get();

        return collect([
            'total' => $course->getAttribute('enrollments_count'),
            'low' => 0,
            'medium' => 0,
            'high' => 0,
        ])->merge($sessions->mapWithKeys(function (\stdClass $object) {
            $item = (array) $object;
            $status = $item['cl_status'] ?? 'low';
            return [$status => $item['total']];
        }));
    }
}
