<div class="flex flex-col gap-3">
    @foreach($sessions as $session)
        <div class="flex items-center justify-between rounded px-4 py-2 even:bg-white even:dark:bg-slate-800 odd:bg-slate-200 odd:dark:bg-slate-800">
            <div class="flex items-center gap-3 flex-1">
                <x-chunks.avatar name="{{ $session->user->name }}" online="{{ $session->user->is_online }}" />
                <span>{{ $session->user->name }}</span>
            </div>
            @if ($session->cl_status === 'high')
                <span class="px-3 py-1 font-semibold text-sm border rounded-full text-red-600 bg-red-500/10 border-red-600">Tinggi</span>
            @endif
            @if ($session->cl_status === 'medium')
                <span class="px-3 py-1 font-semibold text-sm border rounded-full text-yellow-600 bg-red-yellow/10 border-yellow-600">Sedang</span>
            @endif
            @if ($session->cl_status === null)
                <span class="px-3 py-1 font-semibold text-sm border rounded-full text-green-600 bg-red-green/10 border-green-600">Rendah</span>
            @endif
        </div>

    @endforeach
</div>
