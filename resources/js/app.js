require('./bootstrap');

import Vue from 'vue'
import moment from 'moment'
import Toastr from 'vue-toastr'
import VModal from 'vue-js-modal'
import store from './store'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEdit, faPlusSquare, faTrash, faCheckSquare, faEye, faUndo, faSlidersH, faUserPlus, faUsersCog, faLink, faStickyNote} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* == FONTAWESOME == */
library.add(faEdit, faPlusSquare, faTrash, faCheckSquare, faEye, faUndo, faSlidersH, faUserPlus, faUsersCog, faLink, faStickyNote)
Vue.component('font-awesome-icon', FontAwesomeIcon)

/* == vue-toastr == */
Vue.use(Toastr, {
  defaultPosition: "toast-top-right",
  defaultTimeout: 5000,
  defaultCloseOnHover: true,
})

/* == vue-js-modal == */
Vue.use(VModal)

/* == FOCUS IN FIELDS == */
Vue.directive("focus", {
  inserted: el => {
    el.focus();
  }
});

/* == REQUIRE ICON == */
Vue.component('icon', require('./components/misc/Icon').default)

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

var app = new Vue({
    el: '#app',
    store
});
