<div class="flex flex-col overflow-hidden h-full">
    <div class="flex items-center gap-4 justify-end py-4">
        <x-forms.search />
        <a href="#"
           wire:click.prevent="$dispatch('openModal', {component: 'discussion.modal.initial-discussion', arguments: {course: @js($course?->getKey()) } })" class="rounded px-4 py-2 bg-slate-950 hover:bg-red-500 dark:bg-green-600 dark:hover:bg-green-400 text-slate-50 min-w-40 text-center">{{ __("New Discussion") }}</a>
    </div>
    <div class="flex-1 flex border bg-slate-200 dark:bg-transparent dark:border-slate-50/25 overflow-hidden">
        <div class="bg-slate-100 dark:bg-transparent w-1/4 border-r dark:border-slate-50/25 max-h-full flex flex-col">
            <livewire:discussion.filter-panel />
            <div class="flex-1 overflow-x-hidden scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800">
            @foreach($discussions as $key => $discussion)
                <livewire:discussion.box-item :discussion="$discussion" wire:key="{{'discussion-' . $key}}" />
            @endforeach
            </div>
        </div>
        <div class="flex-1">
{{--            <div class="flex h-full justify-center items-center text-2xl text-slate-400 dark:text-slate-500">{{ __("No discussion was selected") }}</div>--}}
            @if( $activeDiscussion !== null)
            <livewire:discussion.container :course="$course" :discussion="$activeDiscussion" />
            @endif
        </div>
    </div>
</div>
