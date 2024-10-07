<div class="h-full flex flex-col gap-1 w-1/2 mx-auto" x-data="{
    currentTab: $wire.entangle('tabIndex'),
    enabledSectionForm: $wire.entangle('enabledFormSection'),
    switchTab(index) {
        if (!this.enabledSectionForm) {
            return
        }
        this.currentTab = index
        $wire.switchTab(this.currentTab)
    },
    enableSectionForm() {
        this.enabledSectionForm = true;
        this.switchTab(1)
    }
}">
    <div class="flex justify-between items-center" @info-saved.window="enableSectionForm()">
        <span class="text-xl font-semibold">{{ $title }}</span>
        <div class="flex items-center gap-2">
            <a href="#" class="px-4 py-3 text-slate-500" :class="currentTab === 0 && 'text-slate-950 dark:text-slate-50'" @click.prevent="switchTab(0)">{{ __("Information") }}</a>
            <a href="#" class="px-4 py-3 text-slate-500" :class="currentTab === 1 && 'text-slate-950 dark:text-slate-50'" @click.prevent="switchTab(1)">{{ __("Sections") }}</a>
        </div>
    </div>
    <div class="flex-1 border">
        <div class="h-full flex justify-center items-center" wire:loading>
            Loading
        </div>
        @if($tabIndex <= 0)
            <livewire:dashboard.quizzes.form :quiz="$quiz" :user="auth()->user()" />
        @else
            <livewire:dashboard.quizzes.form-section :quiz="$quiz" />
        @endif
    </div>
</div>
