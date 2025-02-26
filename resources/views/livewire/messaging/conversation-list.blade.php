<div class="flex flex-col min-h-full" wire:keydown.escape="deselect()">
    @forelse($conversations as $conversation)
        @php
            /** @var \App\Models\User $user */
            $user = $conversation->participants->first();
            $message = $conversation->messages->last();
        @endphp
        <a href="{{ route('profile', ['user' => $user->id]) }}" class="flex items-start gap-2.5 px-4 py-2 {{ $conversation->id === $selectedConversation?->id ? 'bg-white/10' : '' }}" wire:click.prevent="select({{ $conversation->id }})">
            <x-chunks.avatar name="{{ $user->name }}" online="{{ $user->getAttribute('is_online') ? 'true' : 'false' }}"/>
            <div class="flex-1 overflow-hidden">
                <div class="w-[240px] overflow-hidden text-ellipsis text-sm text-nowrap font-bold">{{ $user->name }}</div>
                <div class="w-[240px] overflow-hidden text-ellipsis text-sm text-nowrap">
                    {!! $message?->content !!}
                </div>
            </div>
        </a>
    @empty

    @endforelse
</div>
