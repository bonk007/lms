<x-layouts.blank>
    <x-slot:title>{{ __("Profile: :name", ['name' => $user?->getAttribute('name')]) }}</x-slot:title>

    <div class="py-8">
        <div>
            <div class="flex items-center justify-between">
                <span class="text-2xl">{{ __("Profile: :name", ['name' => $user?->getAttribute('name')]) }}</span>
                @if($user?->getKey() === auth()->id())
                    <x-buttons.link href="{{ route('profile.edit') }}">{{ __("Edit Profile") }}</x-buttons.link>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
                <div class="text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <a href="" class="text-slate-600" disabled>{{ __("Profile: :name", ['name' => $user?->getAttribute('name')]) }}</a>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-4">
            <div class="flex flex-col">
                <span class="text-xs font-semibold">{{ __("Name") }}</span>
                <span>{{ $user?->getAttribute('name') }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-semibold">{{ __("Email") }}</span>
                <span>{{ $user?->getAttribute('email') }}</span>
            </div>
            @if($user?->getKey() !== auth()->id())
            <a href="{{ route('messages') . '?user=' . $user->getKey() . '&create' }}" class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
            </a>
            @endif
        </div>
    </div>

</x-layouts.blank>
