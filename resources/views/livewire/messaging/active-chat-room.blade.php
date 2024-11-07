<div x-data="{
    id: @js($conversation->id),
    init() {
        Echo.join(`conversation.${this.id}`)
            .listen('GotNewMessage', data => {
                $wire.$refresh()
            })
    }
}" class="flex flex-col h-full">
    <div class="flex-1 flex flex-col justify-end">
        @foreach($messages as $message)
            <livewire:messaging.bubble-message :message="$message" :user="$user" :key="$message->getKey()" />
        @endforeach
    </div>
    <div>
        <div class="flex items-center gap-2 p-2">
            <div class="flex-1">
                <x-forms.inputs.wysiwyg wire:model="content" />
            </div>
            <x-buttons.link wire:click.prevent="send">
                <x-icons.paper-plane />
            </x-buttons.link>
        </div>
    </div>
</div>
