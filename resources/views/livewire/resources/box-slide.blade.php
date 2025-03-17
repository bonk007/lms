<div>
    <div class="flex items-center justify-between">
        <div>
            <div class="text-xl font-semibold">{{ $resource->title }}</div>
            <div>{{ $resource->abstract }}</div>
        </div>
        <div class="flex items-center gap-2">
            <a href="#" class="p-8 flex items-center gap-2 bg-white/10 hover:bg-white/30" wire:click.prevent="prev">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span>Previous</span>
            </a>
            <a href="#" class="p-8 flex items-center gap-2 bg-white/10 hover:bg-white/30" wire:click.prevent="next">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span>Next</span>
            </a>
        </div>
    </div>
</div>
