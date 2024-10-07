<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        $section->loadMissing([
            'topic.course',
            'content'
        ]);
        $topic = $section->topic;
        $course = $section->topic->course;
        $content = $section->content;

        if ($content instanceof Resource) {
            $contentTitle = $content->title;
        } else {
            $data = $content->getAttribute('quiz_data');
            $contentTitle = $data['title'];
        }

        return view('components.pages.courses.section', compact(
            'section',
            'topic',
            'course',
            'content',
            'contentTitle'
        ));
    }
}
