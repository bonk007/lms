<div class="mt-8 flex flex-col gap-4">
    <div class="flex items-start">
        <div class="w-10">
            <input type="checkbox" />
        </div>
        <div class="flex-1"></div>
    </div>
    @foreach($notifications as $notification)
        <div class="flex items-start">
            <div class="w-10">
                <input type="checkbox" value="{{ $notification['id'] }}" wire:model.live="selected" />
            </div>
            <a href="#" class="flex-1">
                <div class="font-semibold">{{ $notification['data']['title'] }}</div>
                <div>{{ \Illuminate\Support\Str::limit($notification['data']['message'], 200) }}</div>
            </a>
            <div>
                {{ $notification['created_at'] }}
            </div>
        </div>
    @endforeach
</div>
