<div class="border rounded py-2 px-4">
    <div>
        <div class="mb-4 mt-2">
            <div class="flex gap-2 items-center">
                <span class="font-semibold">{{ $topic->title }}</span>
                @if(!$topic->published)
                    <span class="text-green-700 dark:text-green-300 italic text-xs px-4 py-1 rounded-full border border-green-600">DRAFT</span>
                @endif
            </div>
            <span class="block text-sm italic">{{ $topic->subtitle }}</span>
        </div>
        <div>
            {!! Str::markdown($topic->description) !!}
        </div>
    </div>

    <div class="my-4 border rounded p-4">
        <div class="flex justify-between items-center">
            <a href="#" class="text-blue-500 font-semibold">{{ __("Sections") }}</a>
            @unless($topic->published)
            <a href="#" class="flex items-center gap-2 px-4 py-2 border rounded" wire:click.prevent="$dispatch('openModal', { component: 'dashboard.courses.sections.content-options', arguments: {topic: {{ $topic->getKey() }} } })">
                <x-icons.plus :size="4" />
                <span>Add new section</span>
            </a>
            @endunless
        </div>
        <div class="flex flex-col gap-4 px-4 my-4">
        @foreach($topic->sections as $section)
            @if($section->getAttribute('content_type') === 'quiz_snapshots')
            <div class="flex items-center gap-2 border px-4 py-3">
                <div class="bg-slate-500 px-3 py-2 text-xs font-semibold rounded-full">{{ __("QUIZ") }}</div>
                <a href="{{ route('management.quizzes.edit', ['quiz' => $section->content->quiz]) }}" class="font-semibold">{{  $section->content->quiz->title }}</a>
                @unless($topic->published)
                <div class="flex-1">&nbsp;</div>
                <a href="#"
                   class="p-2 border rounded flex items-center justify-center gap-2"
                   wire:click.prevent="$dispatch('openModal', {component: 'dashboard.courses.sections.quiz-selection', arguments: { topic: {{ $topic->getKey() }}, section: {{ $section->getKey() }} }})">
                    <x-icons.pencil :size="4" />
                </a>
                <a href="#"
                   class="p-2 border rounded flex items-center justify-center gap-2 text-red-700 border-red-500"
                   wire:click.prevent="$dispatch('openModal', { component: 'dashboard.courses.sections.delete-section-confirmation', arguments: { section: {{ $section->getKey() }} } })">
                    <x-icons.trash :size="4" />
                </a>
                @endunless
            </div>
            @else
            <div class="flex items-center gap-2 border px-4 py-3">
                <div class="bg-slate-500 px-3 py-2 text-xs font-semibold rounded-full">{{ __("RESOURCES") }}</div>
                <a href="{{ route('management.resources.show', ['resource' => $section->content]) }}" class="font-semibold">{{  $section->content->title }}</a>
                @unless($topic->published)
                <div class="flex-1">&nbsp;</div>
                <a href="#" class="p-2 border rounded flex items-center justify-center gap-2" wire:click.prevent="$dispatch('openModal', {component: 'dashboard.courses.sections.resource-selection', arguments: { topic: {{ $topic->getKey() }}, section: {{ $section->getKey() }} }})">
                    <x-icons.pencil :size="4" />
                </a>
                <a href="#" class="p-2 border rounded flex items-center justify-center gap-2 text-red-700 border-red-500"
                   wire:click.prevent="$dispatch('openModal', { component: 'dashboard.courses.sections.delete-section-confirmation', arguments: { section: {{ $section->getKey() }} } })">
                    <x-icons.trash :size="4" />
                </a>
                @endunless
            </div>
            @endif
        @endforeach
        </div>
    </div>

    <div class="flex items-center justify-end gap-2">
        @if(!$topic->published)
            <a href="#" class="p-2 border rounded flex items-center justify-center gap-2" wire:click.prevent="publish">
                <x-icons.paper-plane :size="4" />
                <span>{{ __("Publish") }}</span>
            </a>
        @else
            <a href="#" class="p-2 border rounded flex items-center justify-center gap-2" wire:click.prevent="draft">
                <x-icons.archive :size="4" />
                <span>{{ __("Make draft") }}</span>
            </a>
        @endif
        <a href="{{ route('management.topics.edit', ['course' => $topic->course, 'topic' => $topic]) }}" class="p-2 border rounded flex items-center justify-center gap-2">
            <x-icons.pencil :size="4" />
            <span>{{ __("Edit") }}</span>
        </a>
        <a href="#" class="p-2 border rounded flex items-center justify-center gap-2 text-red-700 border-red-500" wire:click.prevent="$dispatch('openModal', { component: 'dashboard.courses.modal.delete-topic-confirmation', arguments: { topic: {{ $topic->getKey() }} } })">
            <x-icons.trash :size="4" />
            <span>{{ __("Delete") }}</span>
        </a>
    </div>
</div>
