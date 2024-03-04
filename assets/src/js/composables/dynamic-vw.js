/**
 * Helper function to set CSS variable for dynamic vw
 * This is useful for getting the correct vw value on resize,
 * because the default vw unit is ignoring the scrollbar width
 */
export default function initVwVariable() {
  setVw()

  window.addEventListener('resize', () => {
    setVw()
  })
  function setVw() {
    let vw = document.documentElement.clientWidth / 100
    document.documentElement.style.setProperty('--vw', `${vw}px`)
  }
}
