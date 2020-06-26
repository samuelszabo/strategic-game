import Toggle from './Utils/toggle'

export default function app () {
  document.querySelector('.js').addEventListener('click', (e) => {
    const toggle = new Toggle()
    toggle.start(e)
  })
}
