import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
import storeModule from './modules/stores/index'
import contactMessageModule from './modules/contactMessage/index'
import brandModule from './modules/brand/index'
import timezoneModule from './modules/timezone/index'
import authModule from './modules/auth/index'

export default new Vuex.Store({
    modules: {
        stores: storeModule,
        contactMessage: contactMessageModule,
        brands: brandModule,
        timezones: timezoneModule,
        auth: authModule
    }
});
