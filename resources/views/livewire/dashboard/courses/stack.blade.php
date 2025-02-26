<div class="flex flex-col">
    <div class="flex items-center justify-between">
        <x-forms.search id="courses-search" name="courses-search" wire:model.debounce="search" />
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <label for="instance" class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __("Instance") }} :</label>
                <select name="instance" id="instance"></select>
            </div>
            <div class="flex items-center gap-2"
                 @order-changed.window="$wire.changeOrderBy($event.detail.selected)"
                 @direction-changed.window="$wire.changeOrderDir($event.detail.dir)">
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __("Sorted by") }} :</span>
                <x-chunks.sorting dir="{{ $orderDir }}" entangle="orderBy" :items="$sortingOptions" />
            </div>

            <div class="border-l">&nbsp;</div>
            <a href="{{ route('management.courses.create') }}" class="flex items-center gap-2 bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>{{ __('New Course') }}</span>
            </a>
        </div>
    </div>
    <div class="flex-1 flex flex-col gap-4 p-4">
    @forelse ($courses as $course)
        <div class="border p-4 flex flex-col gap-2 bg-white dark:bg-slate-800">
            <a href="{{ route('management.courses.show', compact('course')) }}" class="text-xl font-semibold hover:text-red-400">{{ $course->getAttribute('name') }}</a>
            <div class="max-h-32 text-ellipsis overflow-hidden"> {{ $course->description }}</div>
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('management.courses.edit', compact('course')) }}" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </a>
                <a href="#" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </a>
            </div>
        </div>
    @empty
        <div>No course yet</div>
    @endforelse
    </div>
    <div>{{ $courses->links() }}</div>
</div>
