<x-layouts.blank>
    <x-slot:title>{{ __("Edit: :name", ['name' => $user?->getAttribute('name')]) }}</x-slot:title>

    <div class="py-8">
        <div>
            <div class="flex items-center justify-between">
                <span class="text-2xl">{{ __("Profile: :name", ['name' => $user?->getAttribute('name')]) }}</span>
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
                <a href="" class="hover:text-red-600">{{ __("Profile: :name", ['name' => $user?->getAttribute('name')]) }}</a>
                <div class="text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <a href="" class="text-slate-600" disabled>{{ __("Edit") }}</a>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-4">
            <livewire:profile-form :user="$user" />
        </div>
    </div>

</x-layouts.blank>
