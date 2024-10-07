import './bootstrap'
import ckeditor from './ckeditor'
import turnDown from './turndown'
import Hotjar from '@hotjar/browser'

window.ckeditor = ckeditor
window.turnDown = turnDown

Hotjar.init(5135364, 6)
