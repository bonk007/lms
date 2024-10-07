<?php

namespace App\Livewire\Dashboard\Courses;

use App\Livewire\Traits\HasAlert;
use App\Models\Course;
use App\Models\Instance;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads, HasAlert;

    /**
     * @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
     */
    #[Validate('image|max:1024')]
    public $upload;

    public string $name = '';

    public string $description = '';

    public ?Course $course = null;

    public Instance $instance;

    public User $user;

    public Collection $instances;

    public function boot(): void
    {
        $this->user = auth()->user();
        $this->instances = $this->user->initiatedInstances()->get();
        $this->instance = $this->instances->first();
    }

    public function cancel(): void
    {
        $this->redirect(route('management.courses.index'));
    }

    public function toDetail(): void
    {
        $this->redirect(route('management.courses.show', ['course' => $this->course]));
    }

    public function submit(): void
    {
        $validatedData = $this->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
        ]);

        if ($this->upload) {
            $validatedData = [
                ...Arr::except($validatedData, ['upload']),
                ...['banner' => $this->saveFile()]
            ];
        }

        if (null !== $this->course) {
            $this->update($validatedData);
            return;
        }

        $this->create($validatedData);

    }

    protected function create(array $data): void
    {
        $course = new Course($data);

        $course->creator()->associate($this->user);
        $course->instance()->associate($this->instance);

        $course->save();

        $this->course = $course;
        $this->toDetail();
    }

    protected function update(array $data): void
    {
        $this->course->update($data);
        $this->toDetail();
    }

    protected function saveFile(): string
    {
        $dir = $this->instance->getKey() . '/courses/banners';
        $extension = $this->upload->getExtension();
        $name = Str::random() . '.'. $extension;

        return $this->upload->storeAs($dir, $name);
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.form');
    }
}
