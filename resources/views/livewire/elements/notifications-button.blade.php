<a x-data="{
        user: @js($user->id),
        init() {
            subscribePrivateChannel(this.user)
                .notification(notification => {
                    $wire.$dispatch('updated')
                })

        }
    }"
   href="{{ route('notifications') }}"
   class="relative w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-opacity-5 dark:text-slate-50 hover:text-red-500 hover:bg-opacity-10 rounded-full">
    @if($unreadCount > 0)
        <span class="absolute p-1 text-[10px] font-bold text-white bg-red-600 rounded-full text-center right-0 top-0 min-w-6">{{ $unreadCount < 100 ? $unreadCount : '99+' }}</span>
    @endif
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
    </svg>
</a>
