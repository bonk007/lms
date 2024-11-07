<div class="flex h-full border">
    <div class="w-80 h-full overflow-hidden bg-white/15">
        <livewire:messaging.conversation-list :selected-conversation="$selectedConversation" />
    </div>
    <div class="flex-1 h-full overflow-hidden">
        @if($open)
            <livewire:messaging.active-chat-room :conversation="$selectedConversation" :user="$user" />
        @endif
    </div>
</div>
