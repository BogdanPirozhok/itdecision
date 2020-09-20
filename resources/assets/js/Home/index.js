var Vue = require('vue'),
    Vuex = require('vuex'),
    Vuetify = require('vuetify');

window.axios = require('axios');

require('../Common/helper/helper.js');
require('../Common/helper/polyfill.js');

import vuexStore from './store.js';

Vue.use(Vuex);
Vue.use(Vuetify);

Vue.component('confirm-item', require('../Common/components/confirm-item.vue').default);
Vue.component('index',        require('./components/Index.vue').default);

new Vue({
  	el: '#editor',
  	store: new Vuex.Store(vuexStore),
  	vuetify: new Vuetify(),
  	methods:{
  		confirmAction: function(e, data) {
            this.$refs.confirm.action({
                target: e,
                type: data.type,
                confirm: () => {
                    data.action(data.input);
                    this.$refs.confirm.open = false;
                },
                revoke: () => {
                    this.$refs.confirm.open = false;
                }
            })
        }
  	}
});

