<x-layouts.blank>
    <x-slot:title>Course</x-slot:title>

    @if($course->banner !== null)
        <div class="absolute top-0 left-0 w-full bg-slate-300 h-[248px]" style="background: url({{ $course->banner }}); background-position: center top; background-repeat: no-repeat; background-size: cover">&nbsp;</div>
    @endif

    <div class="flex flex-col relative h-full">
        <div class="py-8 px-4 relative bg-white/50 dark:bg-slate-900/50">
            <div class="relative text-2xl font-semibold z-10">{{ __("Courses") }}</div>
            <div class="flex items-center gap-2 relative z-10">
                <a href="{{ route('home') }}" class="hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
                <div class="text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <a href="{{ route('courses') }}" class="hover:text-red-600">{{ __("Courses") }}</a>
                <div class="text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <a href="#" disabled class="text-slate-600">{{ $course->name }}</a>
            </div>
        </div>
        <div class="flex-1 overflow-hidden">
            <livewire:courses.layouts.tab :course="$course" />
        </div>



    </div>

</x-layouts.blank>
