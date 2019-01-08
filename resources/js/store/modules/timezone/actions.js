import api from '../../../services/api';

export const getTimezones = (context, payload) => {
    return new Promise((resolve) => {
        api().get('timezones').then((response) => {
            context.commit('SET_TIMEZONES', response.data.data.timezones);
            resolve();
        }).catch((error) => {
            console.log(error);
        });
    });
};
