<div>
    <div class="px-4 py-3 text-xl">{{ __("Choose the content of the section") }}</div>
    <div class="flex justify-center items-center w-1/4 h-40">
        <x-buttons.link href="#" kind="primary" wire:click.prevent="$dispatch('openModal', {component: 'dashboard.courses.sections.resource-selection', arguments: { topic: {{ $topic->getKey() }} }})">
            <span>{{ __("Resource") }}</span>
        </x-buttons.link>
        <x-buttons.link href="#" kind="danger" wire:click.prevent="$dispatch('openModal', {component: 'dashboard.courses.sections.quiz-selection', arguments: { topic: {{ $topic->getKey() }} }})">
            <span>{{ __("Quiz") }}</span>
        </x-buttons.link>
    </div>
</div>
