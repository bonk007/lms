<div class="flex flex-col gap-4 ">
    @if($resource->getAttribute('streaming') && null !== $resource->getAttribute('content_url'))
        <div class="flex justify-center bg-black">
            <div style="width: 900px; height: 480px" class="mx-auto">
                <x-video-player :uid="$resource->getAttribute('content_url')" />
            </div>
        </div>
    @endif
    <h1 class="text-xl font-semibold">{{ $resource->getAttribute('title') }}</h1>
    <div class="p-4 border rounded border-slate-600">
        <div class="mb-2 text-xl">Abstract</div>
        {!! \Illuminate\Support\Str::markdown($resource->getAttribute('abstract')) !!}
    </div>
    @if($resource->getAttribute('slides')->isNotEmpty())
        @foreach($resource->getAttribute('slides') as $num => $slide)
            <div class="flex justify-center items-center">
                <a href="#"
                   class="font-semibold px-6 py-3 text-red-500 border border-red-500"
                   wire:click.prevent="$dispatch('openModal', {component: 'resources.slide', arguments: {slide: {{ $slide->getKey() }} } } )">Open the Slides #{{ $num + 1 }}</a>
            </div>
        @endforeach
    @endif
    @if($resource->getAttribute('downloadable'))
    <div class="flex justify-center items-center">
        <a href="{{ $resource->getAttribute('content_url') }}"
           class="border border-blue-400 text-blue-500 px-4"
           target="_blank">{{ __("Download the resource here") }}</a>
    </div>

    @endif
    @if($resource->getAttribute('content_mime') === 'text/html')
    <div>
        {!! \Illuminate\Support\Str::markdown($resource->getAttribute('html_content')) !!}
    </div>
    @endif
</div>
