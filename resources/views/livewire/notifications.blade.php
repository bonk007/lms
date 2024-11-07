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
            <a href="#" class="flex-1" wire:click.prevent="read(@js($notification['id']))">
                <div class="{{ $notification['read_at'] === null ? 'font-bold' : '' }} flex items-start gap-2">

                    <span>{{ $notification['data']['title'] }}</span>
                    @if($notification['read_at'] === null)
                        <span class="block w-1.5 h-1.5 rounded-full bg-red-600">&nbsp;</span>
                    @endif
                </div>
                <div class="font-light">{{ \Illuminate\Support\Str::limit($notification['data']['message'], 200) }}</div>
            </a>
            <div>
                {{ $notification['created_at'] }}
            </div>
        </div>
    @endforeach
</div>
