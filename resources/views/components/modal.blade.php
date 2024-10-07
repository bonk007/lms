<div class="fixed flex justify-center items-center top-0 left-0 h-screen w-screen bg-slate-900 dark:bg-slate-50 dark:bg-opacity-25 bg-opacity-25"
     x-data="{
        show: false,
        hide() {
            this.show = false
        },
        display() {
            this.show = true
        }
     }"
     x-show="show" x-transition.350ms> <!-- Modal Overlay -->
    <a href="#" class="absolute right-4 top-4 text-red-500" @click.prevent="hide()">
        <x-icons.close />
    </a>
    <div class="relative bg-slate-50 dark:bg-slate-800 rounded border z-50 p-8" x-on:show-modal.window="display()" x-on:close-modal.window="hide()">
        {{ $slot }}
    </div>
</div>
