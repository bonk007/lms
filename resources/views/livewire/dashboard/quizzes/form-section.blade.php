<div class="flex flex-col gap-2 p-4">
    {{-- Do your work, then step back. --}}
    @forelse(($sections ?? []) as $section)
        {{--        --}}<div class="border">
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
            <div class="flex flex-col gap-2 px-4 py-2">
                <div class="flex justify-end items-center">
                    <x-buttons.link
                        href="#"
                        wire:click.prevent="$dispatch('openModal', {component: 'dashboard.quizzes.questions.form', arguments: { section: {{ $section->getKey() }} } })">
                        <x-icons.plus size="4"/>
                        <span>Add Question</span>
                    </x-buttons.link>
                </div>
                @foreach($section->questions as $key => $question)
                    <div class="border px-4 py-2 flex items-center gap-2">
                        <div class="text-center">
                            #{{ $key + 1 }}.
                        </div>
                        <div class="flex-1 flex items-start gap-4">
                            <div class="bg-slate-300 text-slate-800 px-4 py-1 text-xs rounded-full">{{ \Illuminate\Support\Str::title($question->type) }}</div>
                            <div>
                                {{ $question->getAttribute('html_content') ?? __("Streaming content") }}
                            </div>

                        </div>
                        <div class="flex items-center gap-2">
                            <x-buttons.link kind="warning" href="#" wire:click.prevent="$dispatch('openModal', {component: 'dashboard.quizzes.questions.form', arguments: { section: {{ $section->getKey() }}, question: {{ $question->getKey() }} } })">
                                <x-icons.pencil size="4" />
                            </x-buttons.link>
                            <x-buttons.link kind="danger" href="#" wire:click.prevent="$dispatch('openModal', {component: 'dashboard.quizzes.modal.unassign-question-confirmation', arguments: { section: {{ $section->getKey() }}, question: {{ $question->getKey() }} } })">
                                <x-icons.trash size="4" />
                            </x-buttons.link>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="flex justify-center items-center h-80"><span class="text-xl font-light">{{ __("No section yet") }}</span></div>
    @endforelse
    @if($showSectionForm)
        <livewire:dashboard.quizzes.sections.form :quiz="$quiz" :section="$editableSection" />
    @else
        <div class="flex justify-center items-center">
            <x-buttons.link href="#" kind="primary" wire:click.prevent="showForm()">
                <x-icons.plus />
                <span>{{ __("Create new section") }}</span>
            </x-buttons.link>
        </div>
    @endif
</div>
