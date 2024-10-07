<div class="flex flex-col gap-4 mx-8 my-4">
    <x-forms.inputs.text required wire:model="title" id="title" name="title" label="Title" />
    <x-forms.inputs.text wire:model="subtitle" id="subtitle" name="subtitle" label="Subtitle" />
    <x-forms.inputs.number wire:model="duration" id="duration" name="duration" label="Duration (estimation in minutes)" class="w-1/4" />
    <x-forms.inputs.checkbox wire:model="automatedScoring" name="scoring" id="scoring" label="Automated Scoring" />
    <div class="flex justify-end items-center gap-2">
        <x-buttons.link href="{{ route('management.quizzes.index') }}">Back</x-buttons.link>
        <x-buttons.button kind="primary" wire:click.prevent="submit">
            <span>{{ __("Save and Next") }}</span>
        </x-buttons.button>
    </div>
</div>
