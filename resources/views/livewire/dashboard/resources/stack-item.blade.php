<div x-data="{
    id: @js($resource->getKey()),
    showConfirmation(kind) {
        $dispatch('need-confirmation', {kind, id: this.id})
    }
}" class="border rounded px-4 py-2 mb-2 dark:bg-slate-800">
    <div class="flex items-center gap-4 py-2.5">
        <a href="{{ route('management.resources.show', compact('resource')) }}" class="text-xl hover:text-red-600">{{ $resource->getAttribute('title') }}</a>
        <div class="flex-1">&nbsp;</div>
        @if(!$resource->trashed())
        <x-buttons.link class="text-xs" href="{{ route('management.resources.edit', compact('resource')) }}">
            <x-icons.pencil size="4" />
            <span>Edit</span>
        </x-buttons.link>

        <x-buttons.link kind="danger" class="text-xs" x-on:click.prevent="showConfirmation('delete')">
            <x-icons.trash size="4" />
            <span>Delete</span>
        </x-buttons.link>
        @else
            <x-buttons.link kind="primary" class="text-xs" x-on:click.prevent="showConfirmation('restore')">
                <x-icons.recycle size="4" />
                <span>{{ __("Restore") }}</span>
            </x-buttons.link>

            <x-buttons.link kind="danger" class="text-xs" x-on:click.prevent="showConfirmation('flush')">
                <x-icons.close size="4" />
                <span>{{ __("Flush") }}</span>
            </x-buttons.link>
        @endif
    </div>

    <div>
        {!! Str::markdown(Str::take($resource->getAttribute('abstract'), 255)) !!}
    </div>
</div>
