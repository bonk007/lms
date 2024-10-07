<div class="fixed flex justify-center items-center top-0 left-0 h-screen w-screen bg-slate-900 dark:bg-slate-50 dark:bg-opacity-25 bg-opacity-25"
     x-data="{
        show: $wire.entangle('show'),
        hide() {
            this.show = false
        }
     }"
     x-show="show" x-transition.350ms> <!-- Modal Overlay -->
    <a href="#" class="absolute right-4 top-4 text-red-500" @click.prevent="hide()">
        <x-icons.close />
    </a>
    <div class="relative bg-slate-50 dark:bg-slate-800 rounded border z-50 p-8">
        {{ $slot }}
    </div>
</div>
