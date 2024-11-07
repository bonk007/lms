<div x-data="{
    show: false,
    logout() {
        $refs.logoutAction.submit()
    }
}" class="relative">
    <x-chunks.avatar name="{{ auth()->user()->name }}" online="{{ auth()->user()->getAttribute('is_online') ? 'true' : 'false' }}" x-on:click.prevent="show = !show" />
    <div class="absolute border w-[300px] right-0 top-[calc(100%+1rem)] bg-slate-100 dark:bg-slate-600 rounded px-6 py-2 flex flex-col text-sm" x-show="show" x-transition.linear.300ms>
        <a href="{{ route('profile') }}" class="dark:text-slate-50 hover:text-red-500 px-4 py-2">{{ __('Profile') }}</a>
        <a href="#" class="dark:text-slate-50 hover:text-red-500 px-4 py-2">{{ __('Account Settings') }}</a>
        @can('manage')
            <div class="my-3 border-b border-slate-300 dark:border-slate-600"></div>
            <a href="{{ route('management.home') }}" class="dark:text-slate-50 hover:text-red-500 px-4 py-2">{{ __('Manage') }}</a>
        @endcan
        <div class="my-3 border-b border-slate-300 dark:border-slate-600"></div>
        <a href="#" class="px-4 py-2 dark:text-slate-50 hover:text-red-400" @click.prevent="logout()">{{ __('Logout') }}</a>
        <form action="{{ route('logout') }}" method="post" class="hidden" x-ref="logoutAction">
            @csrf
        </form>
    </div>
</div>
