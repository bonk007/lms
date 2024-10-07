<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopicForm extends Component
{
    public Course $course;

    public ?Topic $topic = null;

    public ?Topic $dependsOn = null;

    public Collection $topicDependencies;

    public string $title = '';

    public string $subTitle = '';

    public string $description = '';

    public array $fields = [
        'title' => '',
        'subTitle' => '',
        'description' => '',
        'dependsOn' => null,
    ];

    public function mount(): void
    {
        $this->title = $this->topic?->getAttribute('title') ?? '';
        $this->subTitle = $this->topic?->getAttribute('subtitle') ?? '';
        $this->description = $this->topic?->getAttribute('description') ?? '';

        $this->initDependencyTopic();
    }

    protected function initDependencyTopic(): void
    {
        $this->topic?->loadMissing(['dependencyTopic']);
        $topic = $this->topic?->dependencyTopic;

        $this->dependsOn = $topic;
        $this->topicDependencies = $this->course->topics()
            ->when($this->topic?->getKey() !== null, fn(Builder $query) => $query->where('id', '!=', $this->topic->getKey()))
            ->get();
    }

    public function submit(): void
    {

        $validated = $this->validate([
            'title' => ['required', 'max:255'],
            'subTitle' => ['required'],
            'description' => ['nullable'],
        ]);

        DB::transaction(function () use ($validated) {
            if ($this->topic instanceof Topic) {
                $this->update($validated);
                return;
            }

            $this->create($validated);
        });

    }

    protected function create( array $data ): void
    {
        $topic = $this->course->topics()
            ->create([
                'title' => $data['title'],
                'subtitle' => $data['subTitle'],
                'description' => $data['description'],
                'created_by' => auth()->id()
            ]);

        $this->depend($topic);

        $this->redirectRoute('management.courses.show', ['course' => $this->course]);

    }

    protected function update(array $data): void
    {
        $this->topic->fill([
            'title' => $data['title'],
            'subtitle' => $data['subTitle'],
            'description' => $data['description'],
        ])->save();

        $this->depend($this->topic);
    }

    protected function depend(Topic $topic): void
    {
        if (!$this->dependsOn instanceof Topic) {
            return;
        }

        $topic->dependencyTopic()
            ->associate($this->dependsOn)
            ->save();
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.topic-form');
    }
}
