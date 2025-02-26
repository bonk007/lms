import localforage from 'localforage'

const sync = async (storage) => {
  const synced = await localforage.getItem(`synced`)
  const records= await localforage.getItem(`records`)
  const url = await localforage.getItem(`url`)

  if (synced) {
    await clear()
    return
  }

  if (records === null || records.length < 1) {
    return
  }

  await window.axios.post(
    `${process.env.APP_URL}/gaze-tracks`,
    {
            url,
            records
          })

  await clear()

}

const clear = async () => {
  await localforage.setItem(`synced`, false)
  await localforage.setItem(`url`, window.location.href)
  await localforage.setItem(`records`, [])
}

const stream = () => {}
