<div class="my-4 flex flex-col gap-4">
    @forelse($topics as $topic)
        <div class="border rounded py-2 px-4">
            <div>
                <div class="mb-4 mt-2">
                    <div class="flex gap-2 items-center">
                        <a href="#" class="font-semibold hover:text-red-500" wire:click.prevent="startSession({{ $topic->getKey() }})">{{ $topic->title }}</a>
                        @if(!$topic->published)
                            <span class="text-green-700 dark:text-green-300 italic text-xs px-4 py-1 rounded-full border border-green-600">DRAFT</span>
                        @endif
                    </div>
                    <span class="block text-sm italic">{{ $topic->subtitle }}</span>
                </div>
                <div>
                    {!! Str::markdown($topic->description) !!}
                </div>
                <div class="flex justify-end items-center">
                    <span>{{ __(":number sections", ['number' => $topic->sections->count()]) }}</span>
                </div>
            </div>
        </div>

    @empty
        <div class="flex p-8 justify-center items-center">
            <span class="font-light text-xl">{{ __("There is no published topic yet") }}</span>
        </div>
    @endforelse
</div>
