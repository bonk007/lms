<div class="grid grid-cols-5 gap-4 my-4 min-h-[282px]">
    @foreach($collection as $data)
        <livewire:courses.card :course="$data" :user="$user" :showEnrollButton="!$enrolled" />
    @endforeach
    @if ($collection->isEmpty())
        <div class="col-span-full flex justify-center items-center border rounded bg-slate-300 dark:bg-opacity-25">
            <div class="text-2xl">{{ $placeholder }}</div>
        </div>
    @endif
    @if($take > 0 && $take < $collection->total())
        <a href="{{ $getMoreUrl }}" class="rounded border dark:border-slate-700 flex justify-center items-center gap-2 bg-blue-500 text-slate-50 hover:bg-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
            </svg>
            <span class="text-2xl">{{ __('show more') }}</span>
        </a>
    @endif
</div>
