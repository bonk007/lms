<div class="border">
    <div class="flex justify-between items-center py-2 px-4">
                <span class="font-semibold text-base">
                    {{ $section->title }}
                </span>
        @unless($showSectionForm)
            <div class="flex items-center gap-2">
                <x-buttons.link href="#" wire:click.prevent="showForm({{ $section->getKey() }})">
                    <x-icons.pencil size="4" />
                </x-buttons.link>
            </div>
        @endunless
    </div>
    <div class="p-4">{!! $section->description !== null ? \Illuminate\Support\Str::markdown($section->description) : '' !!}</div>
    <div>
        <x-buttons.link
            href="#"
            wire:click.prevent="$dispatch('openModal', {component: 'dashboard.quizzes.questions.form'})">
            <x-icons.plus size="4"/>
            <span>Add Question</span>
        </x-buttons.link>
    </div>
</div>
