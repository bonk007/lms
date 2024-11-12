<div class="h-full flex flex-col">
    <div></div>
    <div class="flex-1 px-6 py-4">
    @foreach($assignments as $key => $assignment)
        <livewire:assignments.list-item :course="$course" :assignment="$assignment" wire:key="{{$key}}" />
    @endforeach
    </div>
    <div>
        {{ $assignments->links() }}
    </div>
</div>
