<div class="flex flex-col gap-4">
    <div>
        {!! \Illuminate\Support\Str::markdown($topic->description) !!}
    </div>
    <div>
        <div>
            @foreach($topic->sections as $section)
                <a href="{{ route('section.show', compact('section')) }}" class="border rounded flex items-center gap-2 px-4 py-2 hover:border-red-700">
                    @if($section->content instanceof \App\Models\Snapshots\QuizSnapshot)
                        <x-badge>QUIZ</x-badge>
                        <span>{{ $section->content->quiz->title }}</span>
                    @else
                        <x-badge>{{ __("Resource") }}</x-badge>
                        <span>{{ $section->content->title }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>
