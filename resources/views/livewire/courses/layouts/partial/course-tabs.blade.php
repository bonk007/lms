<div x-data="{
    activeTab: @entangle('activeTab')
}" class="py-4">
    <div class="flex items-center justify-center">
        <a href="#" wire:click.prevent="switch('reading')" class="w-36 py-2 border text-center rounded-s-full" :class="activeTab === 'reading' ? 'bg-slate-100' : 'bg-slate-50'">Reading</a>
        <a href="#" wire:click.prevent="switch('watching')" class="w-36 py-2 border text-center" :class="activeTab === 'watching' ? 'bg-slate-100' : 'bg-slate-50'">Watching</a>
        <a href="#" wire:click.prevent="switch('quiz')" class="w-36 py-2 border text-center rounded-e-full" :class="activeTab === 'quiz' ? 'bg-slate-100' : 'bg-slate-50'">Quiz</a>
    </div>
</div>
