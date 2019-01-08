import {mutations} from './mutations'
import * as actions from './actions'
import * as getters from './getters'

export default {
    state: {
        validationErrors: {},
    },
    mutations: mutations,
    actions: actions,
    getters: getters
};
