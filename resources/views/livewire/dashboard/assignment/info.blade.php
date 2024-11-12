<div class="flex flex-col gap-4">
    <div>
        <span class="text-sm font-semibold">{{ __("Title") }}</span>
        <div class="text-xl font-bold">{{ $assignment->title }}</div>
    </div>
    <div class="flex gap-4 items-center">
        <div>
            <span class="text-sm font-semibold">{{ __("Started at") }}</span>
            <div class="italic">{{ $assignment->getAttribute('started_at')->format('d F Y H:i') }}</div>
        </div>
        @if($assignment->getAttribute('ended_at') !== null)
        <div>
            <span class="text-sm font-semibold">{{ __("Ended at") }}</span>
            <div class="italic">{{ $assignment->getAttribute('ended_at')->format('d F Y H:i') }}</div>
        </div>
        @endif
        <div>
            <span class="text-sm font-semibold">{{ __("Duration") }}</span>
            @if($assignment->getAttribute('ended_at') !== null)
                <div class="italic">{{ $assignment->getAttribute('duration') . ' '.$assignment->getAttribute('duration_unit') }}</div>
            @else
                <div class="italic">{{ __("No limit") }}</div>
            @endif

        </div>
    </div>

    <div>
        <span class="text-sm font-semibold">{{ __("Description") }}</span>
        <div>{!! \Illuminate\Support\Str::markdown($assignment->description) !!}</div>
    </div>
    <div>
        <span class="text-sm font-semibold">{{ __("Attachment(s)") }}</span>
        <div>
            @forelse($assignment->attachments as $attachment)
            @empty
                <span class="italic">N/A</span>
            @endforelse
        </div>
    </div>
</div>
