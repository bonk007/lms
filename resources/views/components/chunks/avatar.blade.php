<div {{ $attributes->except(['name', 'online'])  }} class="w-[42px] h-[42px] flex justify-center items-center bg-slate-50 dark:bg-white/5 dark:text-slate-50 hover:text-red-500 hover:bg-white/10 rounded-full relative">
    <span {{ $attributes->class([
    "block w-3 h-3 rounded-full absolute right-0 top-0",
    'bg-green-600' => $attributes->get('online', 'false') === 'true'
]) }}></span>
    <span class="font-bold">{{ initial($attributes->get('name')) }}</span>
</div>
