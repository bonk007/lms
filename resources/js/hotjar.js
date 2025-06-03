import Hotjar from '@hotjar/browser'

export const hotjarTrack = (user) => {
  Hotjar.init(5135364, 6)

  if (user) {
    Hotjar.identify(user.id, {name: user.name})
  }

}

