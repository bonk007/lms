<?php

namespace App\View\Components\Pages\Courses;

use App\Models\Course;
use App\Models\Resource;
use App\Models\Section as Model;
use App\Models\Snapshots\QuizSnapshot;
use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component
{
    public Topic $topic;

    public Course $course;

    public QuizSnapshot|Resource $content;

    public string $contentTitle;

    /**
     * Create a new component instance.
     */
    public function __construct(public Model $section)
    {
        $this->section->loadMissing([
            'topic.course',
            'content'
        ]);
        $this->topic = $this->section->topic;
        $this->course = $this->section->topic->course;
        $this->content = $this->section->content;

        if ($this->content instanceof Resource) {
            $this->contentTitle = $this->content->title;
        } else {
            $data = $this->content->getAttribute('quiz_data');
            $this->contentTitle = $data['title'];
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.courses.section');
    }
}
