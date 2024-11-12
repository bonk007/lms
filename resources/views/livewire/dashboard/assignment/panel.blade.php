<div class="h-full flex flex-col">
    <div class="flex items-center justify-between">
        <span class="text-xl font-bold">{{ __("Assignments") }}</span>
        <a href="#"
           wire:click.prevent="$dispatch('openModal', {component: 'dashboard.assignment.form', arguments: {course: @js($course->getKey()) } })"
           class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">{{__('New Assignment')}}</a>
    </div>
    <div class="flex-1 flex flex-col gap-4 px-6 py-4">
        @foreach($assignments as $assignment)
            <div>
                <div>
                    <a href="{{ route('management.assignment', compact('course', 'assignment')) }}">{{ $assignment->title }}</a>
                    <div class="flex gap-4 items-center">
                        <span class="italic text-xs">
                            {{ __("Started at ") }}
                            <span class="font-bold">{{ $assignment->getAttribute('started_at')->format('d M Y H:i') }}</span>
                        </span>
                        <span class="italic text-xs">
                            {{ __("Ended at ") }}
                            <span class="font-bold">{{ $assignment->getAttribute('ended_at')?->format('d M Y H:i') ?? '-' }}</span>
                        </span>
                        @if($assignment->getAttribute('ended_at') !== null)
                        <span class="italic text-xs">
                            {{ __("Duration ") }}
                            <span class="font-bold">{{ $assignment->getAttribute('duration') .' '. $assignment->getAttribute('duration_unit')}}</span>
                        </span>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <span class="italic text-xs">
                            {{ __("Attempts ") }}
                            <span class="font-bold">{{ $assignment->getAttribute('attempts_count')}}</span>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $assignments->links() }}
    </div>
</div>
