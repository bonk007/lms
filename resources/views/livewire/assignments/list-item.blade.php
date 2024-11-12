<div class="border rounded shadow px-4 py-2.5">
    <a href="{{ route('courses.assignment.show', compact('course', 'assignment')) }}">{{ $assignment->title }}</a>
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
    @if($this->isTaken())
        <span class="rounded-full border border-gray-600 text-gray-500 text-sm px-6 py-1">
            {{ null === $attempt->scores ? __("Attempted") : __("Score: :score", ['score' => $attempt->scores]) }}
        </span>
    @else
        @if($assignment->getAttribute('is_expired'))
            <span class="rounded-full border border-red-600 text-red-500 text-sm px-6 py-1">
                {{ __("Unavailable") }}
            </span>
        @else
            <span class="rounded-full border border-green-600 text-green-500 text-sm px-6 py-1">
                {{ __("Available") }}
            </span>
        @endif
    @endif
    </div>
</div>
