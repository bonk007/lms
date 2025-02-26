<div class="flex flex-col h-full overflow-y-hidden" x-data="{
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
    }">
    <div class="border-b relative bg-white/50 dark:bg-slate-900/50">
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
            @if(!$this->isAuthorized())
            <div class="flex-1">&nbsp;</div>
            <a href="#" class="flex justify-center items-center px-4 py-2 gap-2 rounded bg-slate-950 dark:bg-green-500 text-slate-50 hover:bg-red-500" wire:click.prevent="enroll">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
                <span>{{__('Enroll')}}</span>
            </a>
            @endif
        </div>
    </div>
    <div class="flex-grow overflow-hidden">
        @if($activeTab === '#courses')
            <livewire:courses.topics.stack :course="$course" :course-session="$session" />
        @endif
        @if($activeTab === '#agenda')
            <livewire:calendar :title="'Agenda'" :course="$course" :user="auth()->user()" />
        @endif
        @if($activeTab === '#assignments')
            <livewire:assignments.panel :course="$course" />
        @endif
        @if($activeTab === '#discussions')
            <livewire:discussion.panel :course="$course" />
        @endif
    </div>

</div>
