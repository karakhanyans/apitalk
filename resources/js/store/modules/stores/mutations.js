export const mutations = {
    'SET_STORES'(state, payload) {
        state.list = payload;
    },
    'STORE_CREATED'(state, payload) {
        state.list.unshift(payload);
    },
    'STORE_UPDATED'(state, payload) {
        state.list.splice(state.list.findIndex(element => element.id === payload.id), 1, payload);
    },
    'SET_STORE'(state, payload) {
        state.store = payload;
    },
    'STORE_VALIDATION_ERRORS'(state, payload) {
        state.validationErrors = payload;
    },
    'STORE_DELETED'(state, payload) {
        state.list.splice(state.list.findIndex(element => element.id === payload.id), 1);
    },
};
