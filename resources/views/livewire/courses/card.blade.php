<div class="rounded border dark:border-slate-700">
    <div class="h-48 flex flex-col justify-between bg-cover" style="background-image: url({{ $course->getAttribute('banner') ?? asset('storage/computer.jpg') }})">
        <div class="px-4 py-1 text-xs italic text-right bg-slate-50/75 dark:bg-slate-50/10">
            {{ __('Published at') }} <span>{{ $course->getAttribute('created_at')->toFormattedDateString() }}</span>
        </div>
        <a href="{{ route('courses.show', ['course' => $course]) }}" class="px-4 py-2 text-lg w-full font-semibold text-nowrap text-ellipsis overflow-x-hidden text-slate-50 hover:text-red-500 bg-slate-950/50 dark:bg-slate-50/10">{{ $course->name }}</a>
    </div>
    <div class="bg-blue-100 dark:bg-opacity-10 flex flex-col gap-2 px-4 py-2">
        <a href="#" class="">{{ $course->getAttribute('author') }}</a>
        <a href="#" class="font-semibold text-xs">{{ $course->getAttribute('instance_name') }}</a>
        <div class="flex justify-between items-center text-xs">
            <div class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
                <span>{{ $course->getAttribute('topics_count') }} topics</span>
            </div>

            <div class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span> {{$course->getAttribute('enrollments_count') > 100 ? '100+' : $course->getAttribute('enrollments_count')}}</span>
            </div>

        </div>
        @if ($showEnrollButton)
            <a href="#" class="flex justify-center items-center px-4 py-2 gap-2 rounded bg-slate-950 dark:bg-green-500 text-slate-50 hover:bg-red-500" wire:click.prevent="enroll">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
                <span>{{__('Enroll')}}</span>
            </a>
        @endif
    </div>
</div>
