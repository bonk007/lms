<div>
    <div class="flex items-center justify-between">
{{--        <div>--}}
{{--            <a href="#" class="py-2 px-4 min-w-36">{{ __('Invite') }}</a>--}}
{{--            <a href="#" class="py-2 px-4 min-w-36">{{ __('Import') }}</a>--}}
{{--            <a href="#" class="py-2 px-4 min-w-36">{{ __('Add new participant') }}</a>--}}
{{--        </div>--}}

        <x-forms.search
            name="participant-search"
            id="participant-search"
            placeholder="{{ __("Search by name or email") }}" wire:model="search" />

    </div>
    <div class="flex flex-col">
        <div class="flex items-center bg-slate-400 dark:bg-slate-50/20">
            <div class="w-2 font-semibold py-4 px-8">No</div>
            <div class="font-semibold py-4 px-8 flex-1">{{ __("Full Name") }}</div>
            <div class="w-80 font-semibold py-4 px-8">{{ __("Email") }}</div>
            <div class="w-20 font-semibold py-4 px-8">{{ __("Status") }}</div>
            <div class="w-60 font-semibold py-4 px-8">{{ __("Last Activity") }}</div>
            <div class="font-semibold py-4 px-8">&nbsp;</div>
        </div>
        @forelse($participants as $key => $participant)
            <div class="flex items-center dark:even:bg-slate-500 hover:!bg-blue-500 hover:text-slate-100 even:bg-slate-200">
                <div class="w-2 py-4 px-8">{{ $key + 1 }}</div>
                <div class="py-4 px-8 flex-1">{{ $participant->user->name }}</div>
                <div class="w-80 py-4 px-8">{{ $participant->user->email }}</div>
                <div class="w-20 py-4 px-8">{{ $participant->user->getAttribute('is_online') ? __("Online") : __("Offline") }}</div>
                <div class="w-60 py-4 px-8">{{ $participant->user->getAttribute('latest_activity_timestamp')->format('d-m-Y H:i:s') }}</div>
                <div class="py-4 px-8">&nbsp;</div>
            </div>
        @empty
            <div class="py-4 px-8 flex-1 text-center">{{ __('No participant yet') }}</div>
        @endforelse
    </div>
    <div class="flex justify-center items-center">
        {{ $participants->links() }}
    </div>
</div>
