import axios from 'axios'
window.axios = axios

const csrf = () => {
  const csrfMetaTag = document.querySelector('meta[name=csrf-token]');
  return csrfMetaTag ? csrfMetaTag.getAttribute('value') : null
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf()
