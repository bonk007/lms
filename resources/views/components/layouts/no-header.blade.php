@extends('layouts.base')
@section('title') Quiz: {{ $title }} @endsection
@section('content')
{{--<div class="h-full px-20 scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-track-slate-800 overflow-x-hidden py-4">--}}
<div class="h-full">
    {{ $slot }}
</div>
@endsection
