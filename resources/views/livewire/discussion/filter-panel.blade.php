<div class="bg-slate-50 dark:bg-slate-50/10 border-b dark:border-slate-600" x-data="{
    optionsShow: false
}">
    <div class="flex items-center p-4">
        <span class="flex-grow">{{ __(":Kind discussions sorted by :sorter", ['kind' => 'all', 'sorter' => 'newest first']) }}</span>
        <a href="#" @click.prevent="optionsShow = !optionsShow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
            </svg>
        </a>
    </div>
    <div class="flex items-start justify-between px-4 py-2 text-sm" x-show="optionsShow" x-transition.350ms>
        <div>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
                <span>{{ __('All') }}</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span>{{ __('Unread') }}</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span>{{ __('Not Responded') }}</span>
            </a>
        </div>
        <div>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
                <span>{{ __('Newest first') }}</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span>{{ __('Most responded') }}</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2">
                <span>{{ __('Most likes') }}</span>
            </a>
        </div>
    </div>
</div>
