import Toggle from './Utils/toggle'

export default function app () {
  document.querySelectorAll('.js').forEach((elem) => {
    elem.addEventListener('click', (e) => {
      const toggle = new Toggle()
      toggle.start(e)
    })
  })

  const autofill = document.querySelector('.js-autofill')
  if (autofill) {
    autofill.addEventListener('click', (e) => {
      e.preventDefault()
      document.querySelector('.js-autofill-target').value = e.target.textContent
    })
  }
}
