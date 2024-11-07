<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class CardsStack extends Component
{
    public bool $enrolled = false;

    public int $take = 10;

    public string $placeholder = "";

    public string $getMoreUrl = "";

    public ?User $user = null;

    protected function dummyUnenrolledCourses(): Collection
    {
        return collect([
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-05-14'),
                'title' => 'Accounting (Beginner)',
                'author' => 'Abraham Gerrard',
                'instance' => 'Harvard University',
                'participants' => 127,
                'topics' => 8
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-01-15'),
                'title' => 'Software Project Management',
                'author' => 'Philip Morris',
                'instance' => 'University of Illinois',
                'participants' => 82,
                'topics' => 16
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-06-01'),
                'title' => 'Accounting (Intermediate)',
                'author' => 'Abraham Gerrard',
                'instance' => 'Harvard University',
                'participants' => 90,
                'topics' => 12
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-06-09'),
                'title' => 'Accounting (Advances)',
                'author' => 'Abraham Gerrard',
                'instance' => 'Harvard University',
                'participants' => 32,
                'topics' => 24
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-01-12'),
                'title' => 'Linux Server',
                'author' => 'Ayi Muhammad Iqbal Nasuha',
                'instance' => 'FAR Capital',
                'participants' => 103,
                'topics' => 12
            ]
        ]);
    }

    protected function dummyEnrolledCourses(): Collection
    {
        return collect([
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-02-23'),
                'title' => 'Machine Learning (Beginner)',
                'author' => 'John Doe',
                'instance' => 'Harvard University',
                'participants' => 365,
                'topics' => 24
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-03-15'),
                'title' => 'Machine Learning (Intermediate)',
                'author' => 'John Doe',
                'instance' => 'Harvard University',
                'participants' => 102,
                'topics' => 16
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-03-25'),
                'title' => 'Machine Learning (Advanced)',
                'author' => 'John Doe',
                'instance' => 'Harvard University',
                'participants' => 43,
                'topics' => 23
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-01-02'),
                'title' => 'Algorithm & Programming',
                'author' => 'Mira Suryani',
                'instance' => 'Padjajaran University',
                'participants' => 24,
                'topics' => 35
            ],
            [
                'published_at' => Carbon::createFromFormat('Y-m-d', '2024-01-12'),
                'title' => 'Data Warehouse',
                'author' => 'Mira Suryani',
                'instance' => 'Padjajaran University',
                'participants' => 101,
                'topics' => 24
            ]
        ]);

    }

    protected function enrolledCoursesQuery(): Builder
    {
        return Course::query()
            ->withCount(['topics', 'enrollments' => fn(Builder $relation) => $relation->where('status', Enrollment::STATUS_APPROVED)])
            ->whereHas('enrollments', fn(Builder $query) => $query->whereBelongsTo(auth()->user(), 'user'));
    }

    protected function availableCoursesQuery(): Builder
    {
        return Course::query()
            ->withCount(['topics', 'enrollments' => fn(Builder $relation) => $relation->where('status', Enrollment::STATUS_APPROVED)])
            ->when($this->user instanceof User, fn (Builder $query) => $query->whereDoesntHave('enrollments', fn(Builder $query) => $query->whereBelongsTo(auth()->user(), 'user'))
            ->where('created_by', '!=', auth()->user()->getKey()));
    }

    public function render(): View
    {
        $query = $this->enrolled ? $this->enrolledCoursesQuery() : $this->availableCoursesQuery();

//        $counts = $collection->count();
        return view('livewire.courses.cards-stack', [
            'collection' => $this->take > 0 ? $query->paginate($this->take) : $query->get(),
            'counts' => 0
        ]);
    }
}
