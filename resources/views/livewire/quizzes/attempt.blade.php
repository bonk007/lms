<div class="flex flex-col gap-4 dark:bg-slate-950 px-20 py-8 min-h-screen">
    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <span class="text-2xl font-semibold">{{ $quizData['title'] }}</span>
            <span class="font-semibold">{{ $quizData['subtitle'] }}</span>
        </div>
        <x-buttons.button kind="primary" wire:click.prevent="submit">
            <span>{{ __("Submit") }}</span>
        </x-buttons.button>
    </div>
    <div class="flex-1">
        <div class="h-full px-20 scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800 overflow-x-hidden py-4">
            <div class="flex flex-col gap-4 border px-6 py-4">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col">
                        <span class="text-xl font-semibold">Section: {{ $currentStructure['title'] ?? '' }}</span>
                        @unless(empty($currentStructure['subtitle'] ?? ''))
                            <span>{{ $currentStructure['subtitle'] ?? '' }}</span>
                        @endunless
                    </div>
                    <div>
                        <span class="font-semibold italic">Description</span>
                        {!! \Illuminate\Support\Str::markdown($currentStructure['description'] ?? '') !!}
                    </div>
                </div>
                <div class="flex-1 flex flex-col gap-4">
                    <span class="font-semibold text-xl">Questions</span>
                    @php
                        $questions = isset($currentStructure['random_order_questions']) && $currentStructure['random_order_questions'] === true
                            ? $currentStructure['randomized_questions']
                            : $currentStructure['questions'];
                    @endphp
                    @foreach($questions as $qKey => $question)

                        <div class="flex items-start gap-4">
                            <div class="font-bold">{{ $qKey + 1 }}.</div>
                            <div>
                                @if ($question['content_url'] !== null)
                                    <div>
                                        <x-video-player :uid="$question['content_url']" />
                                    </div>
                                @else
                                    <div>
                                        {!! \Illuminate\Support\Str::markdown($question['html_content']) !!}
                                    </div>
                                @endif

                                @if ($question['type'] === 'multiple-choices' || $question['type'] === 'single-choice')
                                    <div class="mt-2.5">
                                        @foreach($question['options_without_key'] as $key => $option)
                                            <div class="flex items-center gap-2.5">
                                                @if($question['type'] === 'multiple-choices')
                                                    <input type="checkbox"
                                                           id="{{ "question-".$question['id']."-option-".$key }}"
                                                           value="@js($key)"
                                                           wire:model="{{ "progressData.". $qKey .".answer.".$key }}" />
                                                @else
                                                    <input type="radio"
                                                           id="{{ "question-".$question['id']."-option-".$key }}"
                                                           value="@js($key)"
                                                           wire:model="{{ "progressData.". $qKey .".answer" }}" />
                                                @endif
                                                <label for="{{ "question-".$question['id']."-option-".$key }}">{{ $option['content'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($question['type'] === 'boolean')
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio"
                                                   id="{{ "question-".$question['id']."-option-1" }}"
                                                   wire:model="{{ "progressData.". $qKey .".answer" }}"
                                                   value="1" />
                                            <label for="{{ "question-".$question['id']."-option-1" }}">{{ __("True") }}</label>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio"
                                                   id="{{ "question-".$question['id']."-option-0" }}"
                                                   value="0"
                                                   wire:model="{{ "progressData.". $qKey .".answer" }}" />
                                            <label for="{{ "question-".$question['id']."-option-0" }}">{{ __("False") }}</label>
                                        </div>
                                    </div>
                                @endif


                                <div>
                                    @if ($question['type'] === 'short-answer')
                                        <input type="text"
                                               wire:model="{{ "progressData.". $qKey .".answer" }}" />
                                    @endif
                                    @if($question['type'] === 'essay')
                                        <textarea cols="30"
                                                  rows="10"
                                                  wire:model="{{ "progressData.". $qKey .".answer" }}"></textarea>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
