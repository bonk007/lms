<div class="flex items-center gap-3 border shadow hover:bg-blue-400/30">
    <a href="#" class="flex items-center gap-2">
        <x-chunks.avatar name="{{$attempt->user->name}}" online="{{ $attempt->user->getAttribute('is_online') ? 'true' : 'false' }}" />
        <div>
            <span class="font-semibold">{{ $attempt->user->name }}</span>
            <span class="text-sm italic">{{ $attempt->user->email }}</span>
        </div>
    </a>
    <span class="italic">{{ $attempt->getAttribute('created_at')->format('d M Y H:i:s') }}</span>
</div>
