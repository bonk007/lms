<div class="h-full flex flex-col">
    <div class="flex items-end gap-2">
        <a href="#" wire:click.prevent="switchTab('info')" class="px-6 py-4 {{ $tab === 'info' ? 'font-bold border-b border-red-500' : '' }}">{{ __("Detail") }}</a>
        <a href="#" wire:click.prevent="switchTab('attempts')" class="px-6 py-4 {{ $tab === 'attempts' ? 'font-bold border-b border-red-500' : '' }}">{{ __("Attempts") }}</a>
    </div>
    <div class="flex-1">
        <div wire:loading class="h-full flex justify-center items-center">Loading...</div>
        @if($tab === 'info')
            <livewire:dashboard.assignment.info :course="$course" :assignment="$assignment" />
        @endif
        @if($tab === 'attempts')
            <livewire:dashboard.assignment.attempts :course="$course" :assignment="$assignment" />
        @endif
    </div>
</div>
