@props([
    'items' => []
])

<div x-data="{
    selected: $wire.entangle( @js($attributes->get('entangle')) ),
    direction: @js( $attributes->get('dir', 'desc') ),
    items: @js($items),
    openOptions: false,
    changeDirection() {
        this.direction = this.direction === 'desc' ? 'asc' : 'desc'
        this.$dispatch('direction-changed', {dir: this.direction})
    },
    get selectedItem() {
        if (this.selected === null) {
            return this.items[0]
        }
        return this.items.reduce((current, next) => {
            if (next.id === this.selected) {
                return next
            }
            return current
        }, null)
    },
    select(id) {
        if (this.selected !== id) {
            this.selected = id
            this.$dispatch('order-changed', {selected: this.selected})
        }
        this.openOptions = false
    }
}" class="relative">
    <div class="flex items-center border rounded bg-white dark:bg-slate-800">
        <a href="#" @click.prevent="changeDirection()" class="px-4 py-2.5 border-r">
            <div class="transition-transform" :class="direction === 'desc' && 'rotate-180'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>
            </div>
        </a>
        <a href="#" class="flex items-center gap-2 px-4 py-2.5 w-40" @click.prevent="openOptions = !openOptions">
            <span x-text="selectedItem.label" class="flex-1 text-nowrap text-ellipsis overflow-hidden"></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </a>
    </div>
    <div class="absolute min-w-52 right-0 top-[calc(100% + 2px)] flex flex-col border rounded bg-white dark:bg-slate-800" x-show="openOptions" @click.outside="openOptions = false">
        <template x-for="(item, index) in items" class="flex flex-col">
            <a href="#"
               x-html="item.label"
               class="py-2 px-4 hover:bg-slate-300"
               :class="selectedItem.id === item.id && 'bg-slate-400'" @click.prevent="select(item.id)"></a>
        </template>
    </div>
</div>
