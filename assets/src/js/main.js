// Import custom CSS
import '../scss/main.scss'

// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
// Make Bootstrap's JS available to other JS files
window.bootstrap = bootstrap

// Import custom scripts and files
import initVwVariable from './composables/dynamic-vw'

// Run custom scripts
initVwVariable()
