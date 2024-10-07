import svc from 'turndown'

export default function (htmlValue) {
  return svc.turndown(htmlValue)
}
