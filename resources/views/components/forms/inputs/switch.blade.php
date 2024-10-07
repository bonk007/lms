<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <div x-data="{
        checked: $refs.switchIndicator.checked,
        toggle() {
            this.checked = !this.checked
        }
    }">
        <div class="w-12 rounded-full" :class="checked ? 'bg-green-600' : 'bg-slate-600'">
            <a href="#"
               class="block w-6 h-6 rounded-full"
               @click.prevent="toggle()"
               x-transition.350ms
               :class="checked ? 'bg-green-500 switch-on' : 'bg-slate-300 switch-off'">&nbsp;</a>
        </div>
        <input type="checkbox" {{ $attributes->except([
    'label', 'label-position', 'info', 'entangle'
]) }} x-ref="switchIndicator" x-model="checked" class="hidden" />
    </div>
</x-forms.inputs.container>
