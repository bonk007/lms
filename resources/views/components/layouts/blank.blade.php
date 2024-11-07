@extends('layouts.base')
@section('title'){{ $title ?? null }}@endsection
@section('content')
    <livewire:elements.alert/>
    <div class="flex flex-col h-screen bg-slate-50 dark:bg-slate-900">

        <div class="w-full flex items-center gap-4 pr-20">
            <a href="" class="logo italic py-2 flex flex-col pl-20 pr-4 bg-slate-900 dark:bg-slate-50 text-slate-50 dark:text-slate-950 hover:text-slate-50 hover:bg-red-500">
                <span class="font-semibold text-2xl">LMS</span>
                <span class="text-sm">Adaptive UI/UX</span>
            </a>
            <div class="flex-grow"></div>
            <x-forms.search />
            <div class="flex gap-2">
            @auth()
                <a href="{{ route('agenda') }}" class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </a>
                <a href="{{ route('messages') }}" class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </a>
                <livewire:elements.notifications-button :user="auth()->user()"/>
                <x-chunks.user-dropdown :user="auth()->user()" />
            @else
                <a href="{{ route('login') }}" class="text-slate-950 dark:text-slate-50 hover:text-red-500 rounded px-8 py-2 uppercase">Login</a>
                <a href="{{ route('register') }}" class="text-slate-950 dark:text-slate-50 hover:text-red-500 rounded px-8 py-2 uppercase">Register</a>
            @endauth
            </div>
        </div>

        <div class="h-1 flex-1 w-full overflow-hidden">
            <div class="h-full px-20 scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800 overflow-x-hidden py-4">
                {{ $slot }}
            </div>
        </div>

    </div>
@endsection
