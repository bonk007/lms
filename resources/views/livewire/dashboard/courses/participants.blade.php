<div>
    <div class="flex items-center justify-between">
        <div>
            <a href="#" class="py-2 px-4 min-w-36">{{ __('Invite') }}</a>
            <a href="#" class="py-2 px-4 min-w-36">{{ __('Import') }}</a>
            <a href="#" class="py-2 px-4 min-w-36">{{ __('Add new participant') }}</a>
        </div>

        <x-forms.search
            name="participant-search"
            id="participant-search"
            placeholder="{{ __("Search by name or email") }}" wire:model="search" />

    </div>
    <div class="flex flex-col gap-2">
        <div class="flex items-center">
            <div class="font-semibold py-4 px-8">No</div>
            <div class="font-semibold py-4 px-8 flex-1">{{ __("Full Name") }}</div>
            <div class="font-semibold py-4 px-8">{{ __("Email") }}</div>
            <div class="font-semibold py-4 px-8">{{ __("Status") }}</div>
            <div class="font-semibold py-4 px-8">{{ __("Last Activity") }}</div>
            <div class="font-semibold py-4 px-8">&nbsp;</div>
        </div>
        @forelse($participants as $participant)
        @empty
            <div class="py-4 px-8 flex-1 text-center">{{ __('No participant yet') }}</div>
        @endforelse
    </div>
</div>
