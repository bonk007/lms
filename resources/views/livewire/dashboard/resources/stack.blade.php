<div>
    <div class="flex items-center justify-end gap-4">
        <x-forms.search id="search" name="search" wire:model="search" wire:change="onSearch" />
        <x-forms.inputs.select wire:model="groupBy" wire:change="onSearch" id="group" name="group" label="Group" label-position="left">
        @foreach($groups as $key => $group)
            <option value="{{ $key }}">{{ $group }}</option>
        @endforeach
        </x-forms.inputs.select>
        @unless($hasSelection)
            <div class="mx-4 border-l">&nbsp;</div>
            <x-buttons.link kind="primary" class="text-sm" href="{{ route('management.resources.create') }}">
                <x-icons.plus />
                <span>{{ __("Create new resource") }}</span>
            </x-buttons.link>
        @endunless
    </div>
    <div x-data="{
        showConfirmation(kind, id) {
            $dispatch('need-confirmation', {kind, id})
        }
    }" class="flex flex-col gap-2 my-4">
    @forelse($resources as $key => $resource)
{{--        <livewire:dashboard.resources.stack-item :$resource />--}}
        <div class="border px-4 py-2.5 bg-white dark:bg-slate-700">
<div class="flex items-center">
    <input type="radio" name="resource" id="{{ "resource-".$key }}" value="{{ $resource->getKey() }}" wire:model="selectedResource" wire:change="selectResource">
</div>

            <a href="{{ route('management.resources.show', compact('resource')) }}" class="text-xl">{{ $resource->title }}</a>
            <div class="my-4">
                {!! Str::markdown(Str::take($resource->getAttribute('abstract'), 255)) !!}
            </div>
            @unless($hasSelection)
            <div class="flex items-center gap-2 justify-end">
                @if(!$resource->trashed())
                    <x-buttons.link class="text-xs" href="{{ route('management.resources.edit', compact('resource')) }}">
                        <x-icons.pencil size="4" />
                    </x-buttons.link>

                    <x-buttons.link kind="danger" class="text-xs" x-on:click.prevent="showConfirmation('delete', {{ $resource->getKey() }})">
                        <x-icons.trash size="4" />
                    </x-buttons.link>
                @else
                    <x-buttons.link kind="primary" class="text-xs" x-on:click.prevent="showConfirmation('restore', {{ $resource->getKey() }})">
                        <x-icons.recycle size="4" />
                    </x-buttons.link>

                    <x-buttons.link kind="danger" class="text-xs" x-on:click.prevent="showConfirmation('flush', {{ $resource->getKey() }})">
                        <x-icons.close size="4" />
                    </x-buttons.link>
                @endif
            </div>
            @endunless
        </div>
    @empty
        <div class="h-36 bg-slate-500 justify-center items-center flex">
            <span class="text-xl">{{__("No resource")}}</span>
        </div>
    @endforelse
    </div>
    <div>
        {{ $resources->links() }}
    </div>
    <x-dashboard.pages.resources.confirmation-box />
</div>
