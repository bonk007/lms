<div x-data="{
        focus: false,
        toggleFocus(e) {
           this.focus = e.target.value.length > 0
        }
    }"
     class="flex border bg-slate-100 border-slate-500 dark:border-slate-600 rounded"
     :class="focus ? 'bg-opacity-5' : 'bg-opacity-0'" x-transition.300ms >
    <label class="sr-only" for="{{ $attributes->get('id') ?? 'keywords' }}">&nbsp;</label>
    <input type="text"
           {{ $attributes->merge([
    'name' => 'keywords',
    'id' => 'keywords',
    'placeholder' => __("Search anything here")
]) }}
           class="outline-none border-none bg-transparent dark:text-slate-50"
           x-on:focus="focus = true"
           x-on:blur="toggleFocus" />
    <button class="outline-none border-none bg-transparent text-slate-950 dark:text-slate-50 px-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </button>
</div>
