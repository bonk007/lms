import { getDocument, GlobalWorkerOptions } from "pdfjs-dist";

const PdfViewer = (url, $canvas) => {

  GlobalWorkerOptions.workerSrc = `https://unpkg.com/pdfjs-dist/build/pdf.worker.mjs`
  const loadingTask = getDocument(url)

  return loadingTask.promise
    .then( doc => {
      const numPages = doc.numPages

      const lastPromise = doc.getMetadata()
        .then(({info, metadata}) => {
          console.log("PDF Doc Metadata Info", info)
          if (metadata) {
            console.log("PDF Doc Metadata", metadata)
          }
        })
      const loadPage = pageNum =>
        doc.getPage(pageNum)
          .then(page => {
            if (!$canvas) {
              return
            }

            const viewport = page.getViewport({scale: 1.0})
            const context = $canvas.getContext('2d')

            $canvas.height = viewport.height
            $canvas.width = viewport.width

            let renderContext = {
                canvasContext: context,
                viewport
              },
              renderTask = page.render(renderContext)

            renderTask.promise.then(() => {
              console.log(`Page rendered`)
            })


          }, reason => console.error(reason))

        return {numPages, lastPromise, loadPage}

    })

}

export default PdfViewer
