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
}" class="fixed top-4 right-4 border px-6 py-4 rounded bg-white z-50"
     :class="{
        'border-red-600 bg-red-500/30 text-red-600': severity === 'error',
        'border-green-600 bg-green-500/30 text-green-600': severity === 'success',
        'border-blue-600 bg-blue-500/30 text-blue-600': severity === 'info',
     }"
     x-transition.350ms
     x-show="show"
     x-on:showing.window="handle()">
    {{ $message }}
</div>
