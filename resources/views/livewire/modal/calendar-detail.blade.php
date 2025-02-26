<div>
    <div class="text-center p-4">
        <span class="text-xl font-semibold">Agenda on {{ $date->format('F m, Y') }}</span>
    </div>
    <div class="flex flex-col gap-2 px-6 py-4">
        @foreach($agendas as $agenda)
            <a href="{{ $agenda->getAttribute('action_url') }}" class="border px-6 py-4 text-blue-600 hover:text-red-500 hover:border-red-700">
                <span class="font-semibold">{{ $agenda->title . ' ('.$agenda->getAttribute('going_at')->format('F d, Y H:i:s').')' }}</span>
            </a>
        @endforeach
    </div>
</div>
