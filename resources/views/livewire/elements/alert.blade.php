<div x-data="{
    show: false,
    severity: $wire.entangle('severity'),
    autoHide() {
        if (!this.show) {
            return
        }

        const whenShow = () => {
            $wire.dispatch('hide')
            this.show = false
        }

        setTimeout(whenShow, 3000)

{{--        clearTimeout(timeout)--}}
    },
    handle() {
        this.show = true
        this.autoHide()
    }
}" class="fixed top-4 right-4 border rounded bg-white z-50" x-transition.350ms x-show="show" x-on:showing.window="handle()">
    {{ $message }}
</div>
