import webgazer from 'webgazer'
import localforage from 'localforage'


let lastGaze,
    lastElTime,
    timeout

const configureHeatMap = () => {
  // const config = {
  //   radius: 25,
  //   maxOpacity: .5,
  //   minOpacity: 0,
  //   blur: .75,
  //   container: document.getElementById('tracker-container')
  // }
  //
  // if (window.heatmap !== undefined) {
  //   return
  // }

  webgazer.removeMouseEventListeners();
  document.addEventListener('click', clickListener);

  // window.heatmap = h337.create(config)

}

const clickListener = event => {
  webgazer.recordScreenPosition(event.clientX, event.clientY, 'click');
}

const gazeListener = async (data, elapsedTime) => {
  // console.log(data)
  if (!lastElTime) {
    lastElTime = elapsedTime
  }

  if (lastGaze && lastGaze.x && lastGaze.y) {
    let duration = elapsedTime - lastElTime,
        point = {
          x: Math.floor(lastGaze.x),
          y: Math.floor(lastGaze.y),
          value: duration
        }

    // window.heatmap.addData(point)
    await storeHeatmap(point)
  }

  lastGaze = data
  lastElTime = elapsedTime
}

const storeHeatmap = async (point, blink = null) => {
  let records = await localforage.getItem(`heatmapData`)

  if (records === null) {
    records = []
  }

  records.push({...point, blink})

  localforage.setItem(`heatmapUrl` , window.location.href)
  localforage.setItem(`heatmapData` ,records)

}

const initHeatmapData = async () => {

  await storeHeatmapData()

  localforage.setItem(`heatmapUrl` , window.location.href)
  localforage.setItem(`heatmapData` ,[])

}

const storeHeatmapData = async () => {
  const host = window.location.origin
  const url = await localforage.getItem(`heatmapUrl`)
  const data = await localforage.getItem(`heatmapData`)

  if (url === null || data === null || data.length < 1) {
    return
  }

  window.axios.post(`${host}/gazer-tracks`, {url, data})
    .then(() => {
      localforage.setItem(`heatmapData` ,[])
    })
}


const gaze = async () => {

  await stopGaze()
  const resizeWidth = 10;
  const resizeHeight = 6;

  webgazer.util.getEyeFeats = (eyes) => {
    const process = (eye) => {
      const resized = webgazer.util.resizeEye(eye, resizeWidth, resizeHeight);
      if (!resized) return;
      const gray = webgazer.util.grayscale(
        resized.data,
        resized.width,
        resized.height
      );
      let hist = [];
      webgazer.util.equalizeHistogram(gray, 5, hist);
      return hist;
    };

    // console.log(webgazer)
    // webgazer.isBlink

    if (webgazer.params.trackEye === 'left') {
      return process(eyes.left);
    } else if (webgazer.params.trackEye === 'right') {
      return process(eyes.right);
    }

    return [].concat(process(eyes.left), process(eyes.right));

  }

  await webgazer
    .setRegression('ridge')
    // .setTracker('TFFacemesh')
    .showVideoPreview(false)
    .showPredictionPoints(false)
    .saveDataAcrossSessions(true)
    .begin(() => {
      if (!timeout) {
        timeout = setTimeout(async () => await storeHeatmapData(), 1000 * 60) // store heatmap per minute
      }
    })

  configureHeatMap()
  webgazer.applyKalmanFilter(true)
  webgazer.setGazeListener(gazeListener)
}

const stopGaze = async () => {
  await initHeatmapData()

  if (timeout) {
    clearTimeout(timeout)
  }

  // webgazer.end()
  await localforage.clear()
}

window.addEventListener('load', gaze)
