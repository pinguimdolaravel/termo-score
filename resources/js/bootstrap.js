import lodash from 'lodash'
import axios from 'axios'

// --
// Lodash
window._ = lodash

// --
// Axios
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
