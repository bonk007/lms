<div class="flex flex-col" x-data="{
        activeTab: $wire.entangle('activeTab'),
        isActiveTab(e) {
            const id = e.getAttribute('id')
            const activeId = `#${id}`

            return this.activeTab === activeId

        },
        switchTab(e) {
            const id = e.getAttribute('id')
            const activeId = `#${id}`

            if (this.activeTab === activeId) {
                return
            }

            $wire.switchTab(activeId)

            this.activeTab = activeId
        }
    }" :class="(activeTab === '#discussions' || activeTab === '#agenda') && 'h-full'">
    <div class="border-b relative" >
        <div class="relative -bottom-[1px] flex gap-4 text-slate-500 dark:text-slate-400">
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="courses"
               @click.prevent="switchTab($el)">{{ __('Topics') }}</a>
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="agenda"
               @click.prevent="switchTab($el)">{{ __('Agenda') }}</a>
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="assignments"
               @click.prevent="switchTab($el)">{{ __('Assignments') }}</a>
            <a href="#"
               class="px-4 py-2"
               :class="isActiveTab($el) && 'border-b-4 border-red-500 text-slate-900 dark:text-slate-50'"
               id="discussions"
               @click.prevent="switchTab($el)">{{ __('Discussion') }}</a>
        </div>
    </div>
    @if($activeTab === '#courses')
        <livewire:courses.topics.stack :course="$course" :course-session="$session" />
    @endif
    @if($activeTab === '#agenda')
        <livewire:calendar :title="'Agenda'" />
    @endif
    @if($activeTab === '#assignments')
        <livewire:assignments.panel :course="$course" />
    @endif
    @if($activeTab === '#discussions')
        <livewire:discussion.panel :course="$course" />
    @endif
</div>
