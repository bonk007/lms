<div>
    <div x-data="{
        changeType($event) {
            $wire.changeType($event.target.value)
        }
    }" class="flex flex-col gap-4">
        <div>
            <input type="checkbox" name="is-html" id="is-html" wire:model.live.debounce="isHTML" />
        </div>
        <x-forms.inputs.select label="Type" id="type" name="type" wire:model="type" x-on:change="changeType">
            @foreach($types as $line)
                <option value="{{ $line['key'] }}">{{ $line['label'] }}</option>
            @endforeach
        </x-forms.inputs.select>
        @if ($isHTML)
            <x-forms.inputs.wysiwyg id="content" name="content" label="Content" wire:model="content" required />
        @else
            <x-forms.inputs.file id="file" name="file" wire:model="file" label="Upload File" required />
        @endif

        @if($type === 'boolean')
            <div>
                <span class="font-semibold">{{ __("Correct answer?") }}</span>
                <div class="flex items-center gap-6">
                    <x-forms.inputs.radio id="yes" name="correct" value="1" label="Yes" label-position="right" wire:model="correct" />
                    <x-forms.inputs.radio id="no" name="correct" value="0" label="No" label-position="right" wire:model="correct" />
                </div>
            </div>

        @endif

        @if(in_array($type, ['single-choice', 'multiple-choices']))

            <div class="grid grid-flow-row auto-rows max">
                <div class="grid grid-cols-8 gap-2">
                    <div class="px-4 py-2 font-semibold col-span-6">{{__("Content")}}</div>
                    <div class="px-4 py-2 font-semibold text-center">{{__("Correct?")}}</div>
                    <div class="px-4 py-2 font-semibold text-center">{{__("Remove")}}</div>
                </div>
            @foreach($options as $key => $option)
                <div class="grid grid-cols-8 gap-2">
                    <div class="px-4 py-2 col-span-6">
                        <input type="text"
                               name="{{ "options[".$key."][content]" }}"
                               id="{{ "options-".$key."-content" }}" class="w-full bg-slate-50 text-slate-950 dark:text-slate-100 dark:bg-opacity-5 border border-slate-300 dark:border-slate-600"
                               wire:model="{{ "options.".$key.".content" }}" />
                    </div>
                    <div class="px-4 py-2 text-center">
                        <input type="{{ $type === 'single-choice' ? "radio" : "checkbox" }}"
                               name="correct"
                               id="{{ "options-".$key."-correct" }}"
                               value="1"
                               wire:model="{{ "options.".$key.".correct" }}">
                    </div>
                    <div class="px-4 py-2 text-center">
                        <a href="#" class="text-red-900" wire:click.prevent="removeOption({{$key}})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <x-buttons.link kind="primary" href="#" wire:click.prevent="newOption">Add option</x-buttons.link>
        @endif
    </div>
    <div class="flex justify-end items-center gap-4 mt-10">
        <x-buttons.link href="#" wire:click.prevent="closeModal">{{ __("Cancel") }}</x-buttons.link>
        <x-buttons.link href="#" kind="primary" wire:click.prevent="submit">{{ __("Save") }}</x-buttons.link>
    </div>
</div>
