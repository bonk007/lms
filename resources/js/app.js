import './bootstrap'
import ckeditor from './ckeditor'
import turnDown from './turndown'
import Hotjar from '@hotjar/browser'

window.ckeditor = ckeditor
window.turnDown = turnDown

window.bcPrivateChannel = undefined

Hotjar.init(5135364, 6)

window.subscribePrivateChannel = (user) => {
  if (window.bcPrivateChannel === undefined) {
    window.bcPrivateChannel = Echo.private(`App.Models.User.${user}`)
  }
  return window.bcPrivateChannel
  // return Echo.private(`App.Models.User.${user}`)
  //   .notification(notification => console.log(notification))
}
