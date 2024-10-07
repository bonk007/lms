<div class="flex-grow flex flex-col my-1">
    <div class="flex items-center gap-4 justify-end py-4">
        <x-forms.search />
        <a href="#" class="rounded px-4 py-2 bg-slate-950 hover:bg-red-500 dark:bg-green-600 dark:hover:bg-green-400 text-slate-50 min-w-40 text-center">{{ __("Add new post") }}</a>
    </div>
    <div class="flex-grow flex border bg-slate-200 dark:bg-transparent dark:border-slate-50/25">
        <div class="bg-slate-100 dark:bg-transparent w-1/4 border-r dark:border-slate-50/25 max-h-full overflow-x-hidden scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800">
            <livewire:discussion.filter-panel />
            <div>
                <livewire:discussion.box-item />
                <livewire:discussion.box-item :read="true" />
            </div>
        </div>
        <div class="max-h-full flex-1 overflow-x-hidden scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800">
{{--            <div class="flex h-full justify-center items-center text-2xl text-slate-400 dark:text-slate-500">{{ __("No discussion was selected") }}</div>--}}
            <livewire:discussion.container />
        </div>
    </div>
</div>
