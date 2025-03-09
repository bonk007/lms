<div class="flex flex-col gap-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl">{{ __("Topics") }}</h1>
        <a href="{{ route('management.topics.create', compact('course')) }}" class="px-4 py-2 gap-2 flex border rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>{{ __('Add new topic') }}</span>
        </a>
    </div>
@forelse($topics as $topic)
    <livewire:dashboard.courses.topic-item :$topic wire:key="{{ 'topic-' . $topic->id}}" />
@empty
    <div class="border rounded bg-slate-200 flex items-center justify-center h-36">
        <span class="font-semibold text-slate-500">{{ __('No topic yet') }}</span>
    </div>
@endforelse

</div>
