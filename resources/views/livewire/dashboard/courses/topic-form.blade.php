<div class="flex flex-col gap-4">

    <x-forms.inputs.text
        label="{{ __('Title') }}"
        name="title"
        id="topic-title"
        required
        wire:model="title" />

    <x-forms.inputs.text
        label="{{ __('Subtitle') }}"
        name="subtitle"
        id="topic-subtitle"
        required
        wire:model="subTitle" />

    <x-forms.inputs.wysiwyg
        label="{{ __('Description') }}"
        name="description"
        id="topic-description"
        wire:model="description" />

@if($topicDependencies->isNotEmpty())
    <x-forms.inputs.select
        label="{{ __('Topic Dependency') }}"
        name="depends-on"
        id="topic-dependency"
        wire:model="dependsOn">
        <option>{{ __('No dependency') }}</option>
    @foreach($topicDependencies as $dependency)
            <option value="{{ $dependency->getKey() }}">{{ $dependency->getAttribute('title') }}</option>
    @endforeach
    </x-forms.inputs.select>
@endif

    <div class="flex items-center justify-end">
        <a href="#" class="py-2 px-4 text-slate-600">{{ __("Cancel") }}</a>
        <a href="#" wire:click.prevent="submit" class="py-2 px-4 rounded text-slate-50 bg-slate-900">{{ __("Save") }}</a>
    </div>
</div>
