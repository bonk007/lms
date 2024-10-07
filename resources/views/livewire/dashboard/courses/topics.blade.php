<div class="flex flex-col gap-4">

@forelse($topics as $topic)
    <livewire:dashboard.courses.topic-item :$topic />
@empty
    <div class="border rounded bg-slate-200 flex items-center justify-center h-36">
        <span class="font-semibold text-slate-500">{{ __('No topic yet') }}</span>
    </div>
@endforelse

</div>
