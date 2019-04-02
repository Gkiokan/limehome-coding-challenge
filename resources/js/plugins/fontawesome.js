import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import {} from '@fortawesome/free-regular-svg-icons'

// import {
//   faUser, faLock, faSignOutAlt, faCog, faSignIn
// } from '@fortawesome/free-solid-svg-icons'
//
// import {
//   faGithub
// } from '@fortawesome/free-brands-svg-icons'
//
// library.add(
//   faUser, faLock, faSignOutAlt, faCog, faGithub
// )

// Import all fa icons
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
library.add(fas, far, fab)

Vue.component('fa', FontAwesomeIcon)
