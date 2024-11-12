<div class="px-6 py-4 flex flex-col gap-4">

    <h1 class="mb-3 text-xl font-bold">{{ null === $assignment ? __("New Assignment") : __("Edit Assignment: :title", ['title' => $assignment->title]) }}</h1>

    <x-forms.inputs.text wire:model="title" name="title" id="title" label="{{ __('Title') }}" />

    <x-forms.inputs.wysiwyg wire:model="description" name="description" id="description" label="{{ __('Description') }}">
        {{ $description }}
    </x-forms.inputs.wysiwyg>

    <div class="flex gap-4 items-center">
        <x-forms.inputs.date min="{{ $minDateTime[0] }}" wire:model="startedDate" name="started-date" id="started-date" label="{{ __('Started date') }}" />
        <x-forms.inputs.time min="{{ $minDateTime[1] }}" wire:model="startedTime" name="started-time" id="started-time" label="{{ __('Started time') }}" />
    </div>

    <div class="flex gap-4 items-center">
        <x-forms.inputs.select wire:model="durationUnit" name="duration-unit" id="duration-unit" label="{{ __('Duration Unit') }}">
            <option value="0">{{ __("No limit") }}</option>
            <option value="1">{{ __("Minutes") }}</option>
            <option value="2">{{ __("Hours") }}</option>
            <option value="3">{{ __("Days") }}</option>
        </x-forms.inputs.select>

        @if(null === $durationUnit)
        <x-forms.inputs.number wire:model="duration" name="duration" id="duration" label="{{ __('Duration') }}"/>
        @endif
    </div>

    <x-forms.inputs.dropzone />

    <div class="flex justify-end items-center gap-4">
        <a href="#" wire:click.prevent="$dispatch('closeModal')">{{ __('Cancel') }}</a>
        <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded" wire:click="save">{{__('Save')}}</button>
    </div>
</div>
