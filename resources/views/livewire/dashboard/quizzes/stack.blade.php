<div class="flex flex-col h-full">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold px-4 py-2.5">{{ __("Manage Quizzes") }}</h1>
        <div class="flex justify-end items-center gap-4">
            <x-forms.search id="quiz-search" name="quiz-search" wire:model="search" />
            <div class="flex items-center gap-2"
                 @order-changed.window="$wire.changeOrderBy($event.detail.selected)"
                 @direction-changed.window="$wire.changeOrderDir($event.detail.dir)">
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __("Sorted by") }} :</span>
                <x-chunks.sorting dir="{{ $direction }}" entangle="orderBy" :items="$sortingOptions" />
            </div>
            @unless($enableSelection)
            <x-buttons.link href="{{ route('management.quizzes.create') }}" kind="primary">
                <x-icons.plus />
                <span>{{ __("Add new Quiz") }}</span>
            </x-buttons.link>
            @endif
        </div>
    </div>
    <div class="flex-1 flex flex-col gap-2">
        @forelse($quizzes as $quiz)
            @if($enableSelection)
                <div class="grid grid-col-5 gap-2">
                    <input type="radio"
                           name="selection"
                           id="{{ "selection-" . $quiz->getKey() }}"
                           value="{{ $quiz->getKey() }}"
                           wire:model.live="selectedQuiz"
                           wire:change="quizSelected" />
                </div>
            @endif
            <div class="grid grid-col-5 gap-2">
                <div class="px-4 py-2">
                    <a href="{{ route('management.quizzes.edit', compact('quiz')) }}">
                        <span class="block text-base font-semibold">{{ $quiz->title }}</span>
                        <span class="text-sm font-light">{{ $quiz->subtitle }}</span>
                    </a>
                </div>
                <div class="px-4 py-2"></div>
                <div class="px-4 py-2"></div>
                <div class="px-4 py-2"></div>
            </div>
        @empty
            <div class="flex justify-center items-center w-full h-full">
                <span class="font-light text-2xl text-slate-600">{{ __("No quiz yet") }}</span>
            </div>
        @endforelse
    </div>
    <div>{{ $quizzes->links() }}</div>
</div>
