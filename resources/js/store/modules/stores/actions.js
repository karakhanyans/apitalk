import api from '../../../services/api';

export const getStores = (context, payload) => {
    return new Promise((resolve) => {
        api().get('store?page=' + payload.page).then((response) => {
            context.commit('SET_STORES', response.data.data.stores.data);
            resolve();
        }).catch((error) => {
            console.log(error);
        });
    });
};
export const createStore = (context, {form}) => {
    return new Promise((resolve, reject) => {
        api().post('store', form).then((response) => {
            context.commit('STORE_CREATED', response.data.data.store);
            resolve();
        }).catch((error) => {
            console.log(error);
            context.commit('STORE_VALIDATION_ERRORS', error.response.data.errors['validation']);
            reject();
        });
    });
};
export const getStore = (context, {id}) => {
    return new Promise((resolve) => {
        api().get('store/' + id).then((response) => {
            context.commit('SET_STORE', response.data.data.store);
            resolve();
        });
    });
};
export const editStore = (context, {id, form}) => {
    return new Promise((resolve, reject) => {
        api().post('store/' + id, form).then((response) => {
            context.commit('STORE_UPDATED', response.data.data.store);
            resolve();
        }).catch((error) => {
            context.commit('STORE_VALIDATION_ERRORS', error.response.data.errors['validation']);
            reject();
        });
    });
};
export const deleteStore = (context, {id}) => {
    return new Promise((resolve) => {
        api().delete('store/' + id).then(() => {
            context.commit('STORE_DELETED', {id: id});
            resolve();
        });
    });
};
