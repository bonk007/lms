<div x-data="{
    quizSelected(detail) {
        const [param] = detail
        $wire.select(parseInt(param.quiz))
    }
}" x-on:quiz-selected.window="quizSelected($event.detail)">
    <div class="px-4 py-3 text-xl">
        {{ __("Select Quiz") }}
    </div>

    <livewire:dashboard.quizzes.stack :enable-selection="true" :selected-quiz="$quiz?->getKey()" />

    <div class="flex justify-end items-center gap-4">
        <x-buttons.link href="#" wire:click.prevent="closeModal">
            <span>{{ __("Cancel") }}</span>
        </x-buttons.link>
        <x-buttons.link href="#" kind="primary" wire:click.prevent="submit">
            <span>{{ __("Save") }}</span>
        </x-buttons.link>
    </div>
</div>
