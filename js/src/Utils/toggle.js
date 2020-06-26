export default class Toggle {
  start (e) {
    e.preventDefault()
    this.toggle(e.nextElementSibling)
  }

  show (e) {
    e.style.display = 'block'
  }

  hide (e) {
    e.style.display = 'none'
  }

  toggle (e) {
    if (e.display === 'block') {
      this.hide(e)
      return
    }

    this.show(e)
  }
}
