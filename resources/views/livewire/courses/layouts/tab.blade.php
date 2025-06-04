<div class="flex flex-col h-full overflow-y-hidden" x-data="{
        activeTab: $wire.entangle('activeTab'),
        isActiveTab(e) {
            const id = e.getAttribute('id')

            return this.activeTab === id

        },
        switchTab(e) {
            const id = e.getAttribute('id')

            if (this.activeTab === id) {
                return
            }

            $wire.switchTab(id)

            this.activeTab = activeId
        }
    }">
    <div class="border-b relative bg-white/50 dark:bg-slate-900/50">
        <div class="relative -bottom-[1px] flex gap-4 text-slate-500 dark:text-slate-400">
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="course"
               @click.prevent="switchTab($el)">{{ __('Course') }}</a>
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="discussion"
               @click.prevent="switchTab($el)">{{ __('Discussion') }}</a>
        </div>
    </div>
    <div class="flex-grow overflow-hidden">
        @if($activeTab === 'course')
            <livewire:courses.layouts.partial.course-tabs :course="$course" />
        @endif
        @if($activeTab === 'discussion')
            <livewire:discussion.panel :course="$course" />
        @endif
    </div>

</div>
