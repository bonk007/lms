<div class="flex flex-col h-full">
    <div class="flex-1 flex flex-col-reverse gap-2 px-6  py-4">
        @foreach($posts as $post)
            <div class="border rounded px-4 py-2 {{ auth()->user()->id === $post->getAttribute('user_id') ? 'bg-blue-400/50' : '' }}">
                <a href="#" class="flex gap-2 items-center">
                    <x-chunks.avatar name="{{ $post->user->name }}" online="{{ $post->user->getAttribute('is_online') ? 'true' : 'false' }}"/>
                    <span class="font-semibold">{{ $post->user->name }}</span>
                </a>
                <div>{{ $post->content }}</div>
            </div>
        @endforeach
    </div>
    <livewire:discussion.inline-form :course="$course" :discussion="$discussion" />
</div>
