<div class="flex flex-col border h-full">
    <div class="flex-1 overflow-hidden ">
        <div class="h-full flex flex-col-reverse gap-2 px-6 py-4 overflow-x-hidden scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800">
            @foreach($posts as $post)
                <div class="border rounded px-4 py-2 {{ auth()->user()->id === $post->getAttribute('user_id') ? 'bg-blue-400/50' : '' }}">
                    <a href="{{ route('profile', ['user' => $post->user->id]) }}" class="flex gap-2 items-center">
                        <x-chunks.avatar name="{{ $post->user->name }}" online="{{ $post->user->getAttribute('is_online') ? 'true' : 'false' }}"/>
                        <span class="font-semibold">{{ $post->user->name }}</span>
                    </a>
                    <div>{{ $post->content }}</div>
                </div>
            @endforeach
        </div>

    </div>
    <livewire:discussion.inline-form :course="$course" :discussion="$discussion" />
</div>
