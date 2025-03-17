@props([
    'url' => ''
])
<div x-data="{
    page: 1,
    total: 1,
    url: @js($url),
    viewer: null,
    async init() {
        if (null !== this.viewer) {
            return
        }
        this.viewer = await PdfViewer(this.url, $refs.canvas)
        this.total = this.viewer.numPages
        this.loadPage()
    },
    loadPage() {
        this.viewer?.loadPage(this.page)
    },
    nextPage() {
        if(this.page < this.total) {
            this.page += 1
        }

        this.loadPage()
    },
    prevPage() {
        if (this.page > 1) {
            this.page -= 1;
        }

        this.loadPage()
    }
}">
    <div class="flex justify-between mb-2">
        <a href="#" class="px-8 py-2 font-bold border rounded" x-on:click.prevent="prevPage()">Prev</a>
        <a href="#" class="px-8 py-2 font-bold border rounded" x-on:click.prevent="nextPage()">Next</a>
    </div>

    <canvas class="w-full min-h-[640px]" id="pdf-canvas" x-ref="canvas"></canvas>
</div>

@push('scripts')
    <script type="module">
        {{--PdfViewer(@js($url), document.getElementById('pdf-canvas'))--}}
        {{--  .then(({loadPage}) => loadPage(1))--}}
    </script>
    {{--<script src="https://unpkg.com/pdfjs-dist/build/pdf.mjs" type="module" defer></script>
    <script type="module">
        let url = @js($url),
          {pdfjsLib} = globalThis

        console.log(pdfjsLib)

        pdfjsLib.GlobalWorkerOptions.workerSrc = `https://unpkg.com/pdfjs-dist/build/pdf.worker.mjs`

        let loadingTask = pdfjsLib.getDocument(url)

        loadingTask.promise.then(pdf => {
          let pageNumber = 1
          pdf.getPage(pageNumber).then(page => {
            console.log(page)
            let scale = .8,
                viewport = page.getViewport({scale}),
                canvas = document.getElementById('pdf-canvas'),
                context= canvas.getContext('2d')

            canvas.height = viewport.height
            canvas.width = viewport.width

            let renderContext = {
              canvasContext: context,
              viewport
            },
                renderTask = page.render(renderContext)

            renderTask.promise.then(() => {
              console.log(`Page rendered`)
            })
          })
        }, reason => console.error(reason))
    </script>--}}
@endpush
