@php
    $messages = [
        'delete' => __("Are you sure you want to delete this resource? It will be marked as trashed"),
        'restore' => __("Are you sure you want to restore this resource?"),
        'flush' => __("Are you sure you want to flush this resource? It means this resource will be gone completely"),
    ];
@endphp
<div x-data="{
    showModal: false,
    messages: @js($messages),
    message: null,
    detail: {},
    needConfirmation($event) {
        const {detail} = $event
        this.detail = detail
        this.message = this.messages[detail.kind]
        $dispatch('show-modal')
    },
    closeModal() {
        this.message = null
        $dispatch('close-modal')
        console.log('closing modal')
    },
    confirm() {
        $wire.dispatch(this.detail.kind, {resource: this.detail.id})
        this.closeModal()
    }
}" x-on:need-confirmation.window="needConfirmation($event)">
    <x-modal>
        <div>
            <div x-html="message"></div>
            <div class="flex justify-between items-center">
                <x-buttons.link x-on:click.prevent="closeModal()">{{ __("Cancel") }}</x-buttons.link>
                <x-buttons.link kind="danger" x-on:click.prevent="confirm()">{{ __("Confirmed") }}</x-buttons.link>
            </div>
        </div>
    </x-modal>
</div>
