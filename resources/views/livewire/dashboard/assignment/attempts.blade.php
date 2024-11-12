<div class="h-full flex flex-col">
    <div></div>
    <div class="flex-1 flex flex-col gap-2">
    @foreach($attempts as $attempt)
        <livewire:dashboard.assignment.attempt :attempt="$attempt" :assignment="$assignment"/>
    @endforeach
    </div>
    <div></div>
</div>
