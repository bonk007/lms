<div class="flex flex-col gap-4">

{{--    <x-forms.inputs.dropzone--}}
{{--        label="Banner"--}}
{{--        name="banner"--}}
{{--        id="banner"--}}
{{--        wire:model="upload"--}}
{{--        :rules="['image', 'max:1024']" />--}}
    <livewire:dropzone
        wire:model="upload"
        wire:key="dz-1"
        :rules="['image', 'max:1024']"
        :multiple="false" />

    <x-forms.inputs.select
        label="Instance"
        name="instance"
        id="instance"
        wire:model="instance">
        @foreach($instances as $model)
            <option value="{{ $model->getKey() }}">{{ $model->getAttribute('name') }}</option>
        @endforeach
    </x-forms.inputs.select>

    <x-forms.inputs.text
        name="name"
        id="name"
        wire:model="name"
        placeholder="{{ __('Course\'s title') }}"
        label="Title"
        required />

    <x-forms.inputs.wysiwyg
        label="Description"
        name="description"
        id="description"
        wire:model="description"
        placeholder="{{ __('Course\'s short description') }}"
        required>{{ $description }}</x-forms.inputs.wysiwyg>

    <div class="flex items-center justify-end gap-4">
        <a href="#" wire:click.prevent="cancel">{{ __('Cancel') }}</a>
        <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded" @click.prevent="$wire.submit()">{{__('Save')}}</button>
    </div>

</div>
