<x-layouts.blank>
    <x-slot:title>{{ $contentTitle }}</x-slot:title>
    <div class="py-8">
        <div class="text-2xl font-semibold">{{ $contentTitle }}</div>
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </a>
            <div class="text-slate-600 dark:text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <a href="{{ route('courses') }}" class="hover:text-red-600">{{ __("Courses") }}</a>
            <div class="text-slate-600 dark:text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <a href="{{ route('courses.show', compact('course')) }}" class="hover:text-red-600">{{ $course->name }}</a>
            <div class="text-slate-600 dark:text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <a href="{{ route('courses.topics.show', compact('course', 'topic')) }}" class="hover:text-red-600">{{ $topic->title }}</a>
            <div class="text-slate-600 dark:text-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <a href="#" disabled class="text-slate-600">{{ $contentTitle }}</a>
        </div>
    </div>

    @if($content instanceof \App\Models\Resource)
        <livewire:dashboard.resources.preview :resource="$content" />
    @else
        <livewire:quizzes.preface :snapshot="$content" />
    @endif
</x-layouts.blank>
