import axios from 'axios';
import * as bootstrap from 'bootstrap';

// Attach Axios to window object for global availability
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Attach Bootstrap to window object (enables JS components like dropdowns/modals)
window.bootstrap = bootstrap;