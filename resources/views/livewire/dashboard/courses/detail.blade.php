<div>
@unless($course->getAttribute('banner'))
    <div>{{ $course->getAttribute('banner') }}</div>
@endunless
    <div class="flex items-start gap-4">
        <div class="flex-1 flex flex-col gap-4">
            <div>
                <h1 class="text-xl">{{ $course->getAttribute('name') }}</h1>
                <div>{{ $course->getAttribute('description') }}</div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <h1 class="text-xl">{{ __('Topics') }}</h1>
                    <a href="{{ route('management.topics.create', compact('course')) }}" class="px-4 py-2 gap-2 flex border rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>{{ __('Add new topic') }}</span>
                    </a>
                </div>
                <div class="mt-4">
                    <livewire:dashboard.courses.topics :course="$course" />
                </div>
            </div>
        </div>
        <div class="w-1/4">

        </div>
    </div>
</div>
