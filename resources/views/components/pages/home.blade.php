<x-layouts.blank>
    <x-slot:title>Home</x-slot:title>
    @auth()
        <div class="py-8">
            <span class="text-xl font-semibold">{{ __("Enrolled Courses") }}</span>
            <livewire:courses.cards-stack
                :take="4"
                :user="auth()->user()"
                :enrolled="true"
                :placeholder="__('You don\'t have any enrolled course yet ')"
                :get-more-url="route('courses', ['enrolled'])" />
        </div>
    @endauth
    <div class="py-8">
        <span class="text-xl font-semibold">{{ __('Available Courses') }}</span>
        <livewire:courses.cards-stack
            :take="4"
            :user="auth()->user()"
            :placeholder="__('There is no available course at this moment')"
            :enrolled="false" :get-more-url="route('courses')" />
    </div>
</x-layouts.blank>
