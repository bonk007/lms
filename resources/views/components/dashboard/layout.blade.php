@extends('layouts.base')
@section('title'){{ $title ?? null }}@endsection
@section('content')
    <livewire:elements.alert/>
    <div x-data="{
        drawerOpen: false
    }"
         class="relative bg-slate-50 dark:bg-slate-900" @keyup.escape="drawerOpen = false">
        <div class="absolute h-full w-full bg-slate-800 bg-opacity-25 overflow-hidden z-50" x-show="drawerOpen">
            <div class="w-[360px] bg-slate-50 dark:bg-slate-700 border-r dark:border-slate-600 h-full" @click.outside="drawerOpen = false">
                <div class="flex justify-between items-center">
                    <a href="" class="logo italic py-2 flex flex-col pl-20 pr-4 bg-slate-900 dark:bg-slate-50 text-slate-50 dark:text-slate-950 hover:text-slate-50 hover:bg-red-500">
                        <span class="font-semibold text-2xl">LMS</span>
                        <span class="text-sm">Adaptive UI/UX</span>
                    </a>
                    <a href="" class="px-4 hover:text-red-500" @click.prevent="drawerOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                </div>
                <div class="my-8 pl-20">
                    <div>
                        <a href="#" class="flex items-center p-4 gap-4 hover:text-slate-50 hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                            <span class="flex-1">{{ __("Home") }}</span>
                        </a>
                        <a href="{{ route('management.courses.index') }}" class="flex items-center p-4 gap-4 hover:text-slate-50 hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                            <span class="flex-1">{{ __("Course") }}</span>
                        </a>
                        <a href="{{ route('management.resources.index') }}" class="flex items-center p-4 gap-4 hover:text-slate-50 hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                            <span class="flex-1">{{ __("Resources") }}</span>
                        </a>
                        <a href="{{ route('management.quizzes.index') }}" class="flex items-center p-4 gap-4 hover:text-slate-50 hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                            <span class="flex-1">{{ __("Quizzes") }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col h-screen w-full">
            <div class="w-full flex items-center gap-4 pr-20">
                <a href="" class="logo italic py-2 flex flex-col pl-20 pr-4 bg-slate-900 dark:bg-slate-50 text-slate-50 dark:text-slate-950 hover:text-slate-50 hover:bg-red-500">
                    <span class="font-semibold text-2xl">LMS</span>
                    <span class="text-sm">Adaptive UI/UX</span>
                </a>
                <a href="" @click.prevent="drawerOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </a>
                <div class="flex-1"></div>
                <x-forms.search />
                <div class="flex gap-2">
                    <a href="{{ route('agenda') }}" class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </a>
                    <a href="#" class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </a>
                    <livewire:elements.notifications-button :user="auth()->user()"/>
                    <x-chunks.user-dropdown :user="auth()->user()" />
                </div>
            </div>
            <div class="flex-1 overflow-hidden my-4">
                <div class="h-full scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800 overflow-x-hidden">
                    {{ $slot }}
                </div>
            </div>

        </div>

    </div>
@endsection
