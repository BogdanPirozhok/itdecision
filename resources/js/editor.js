 window.scroll_hidden = function(comp) {
    if ( !window.overlay || (window.overlay && comp == window.overlay) ) {
        var coef = document.documentElement.scrollHeight - window.innerHeight,
            bcg = document.querySelector('.bcg-item');

        if ( document.body.classList.contains('_scroll_hidden') ) {
            setTimeout(function(){
                document.body.classList.remove('_scroll_hidden');
                document.body.style.marginRight = '0px';

                if ( bcg ) {
                    bcg.style.width = '100%';
                }
            }, bcg ? 350 : 10)

            window.overlay = false;
        }else{
            if ( coef > 0 ) {
                var offset = window.innerWidth - document.body.clientWidth;

                document.body.style.marginRight = offset +'px';

                if ( bcg ) {
                    bcg.style.width = 'calc(100% - '+ offset +'px)';
                }
            }
            document.body.classList.add('_scroll_hidden');
            window.overlay = comp;
        }
    }
}

var Vue = require('vue');
var Vuetify = require('vuetify');
var Vuex = require('vuex');

Vue.use(Vuex);
Vue.use(Vuetify);

import objStore from './store.js';

const store = new Vuex.Store(objStore);

window.axios = require('axios');



Vue.component('confirm-form', require('./components/confirm-item.vue').default);
Vue.component('index', require('./components/Index.vue').default);
Vue.component('base-alert', require('./components/Alert.vue').default);
Vue.component('base-material-card', require('./components/MaterialCard.vue').default);
Vue.component('base-material-stats-card', require('./components/MaterialStatsCard.vue').default);
Vue.component('base-material-chart-card', require('./components/MaterialChartCard.vue').default);
new Vue({
  	el: '#editor',
  	store,
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

