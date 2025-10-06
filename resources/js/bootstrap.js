import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    window.$ = window.jQuery = require('jquery');
    require('jquery-validation');
    require('datatables.net-bs5');
    window.Swal = require('sweetalert2');
} catch (e) {}