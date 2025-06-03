import './bootstrap'
import ckeditor from './ckeditor'
import turnDown from './turndown'
import PdfViewer from "./pdf-viewer.js";
import {hotjarTrack} from "./hotjar.js";

window.ckeditor = ckeditor
window.turnDown = turnDown

window.bcPrivateChannel = undefined

window.subscribePrivateChannel = (user) => {
  if (window.bcPrivateChannel === undefined) {
    window.bcPrivateChannel = Echo.private(`App.Models.User.${user}`)
  }
  return window.bcPrivateChannel
  // return Echo.private(`App.Models.User.${user}`)
  //   .notification(notification => console.log(notification))
}

window.PdfViewer = PdfViewer
window.hotjar = hotjarTrack
