export const mutations = {
    'SET_USER'(state, payload) {
        state.user = payload;
    },
    'UNSET_USER'(state, payload) {
        state.user = null;
    }
};
